<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\Plan;
use App\Models\Dashboard\Membership\PurchaseHistory;
use App\Models\Dashboard\Vendor\Settings\Category;
use App\Models\Dashboard\Vendor\Settings\Type;
use App\Models\Dashboard\Vendor\VendorDetail;
use App\Models\Roles\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{

    public function index() {

        $planCounts = Member::select('plan_id', DB::raw('count(*) as total'))
            ->groupBy('plan_id')
            ->pluck('total', 'plan_id')
            ->all();
        $getplans = Plan::pluck('id')->all();
        foreach ($getplans as $planId) {
            if (!isset($planCounts[$planId])) {
                $planCounts[$planId] = 0;
            }
        }
        $result = array_values($planCounts);
        $categories = [];
        $types = [];

        if (auth()->user()->hasRole(['Customer'])) {
            $boxs = $this->customerdashbox();
            $plans = Plan::orderBy('price', 'asc')->get();
            $member = Member::where('customer_id', auth()->user()->id)->first();

        } elseif (auth()->user()->hasRole(['vendor'])) {
            $boxs = $this->vendordashbox();
            $member = [];
            $plans = [
                'plans' => Plan::pluck('name'),
                'total' => json_encode(array_values($planCounts)),
                'colors' => Plan::pluck('color')
            ];
            $categories = $this->countVendorCategories();
            $types = $this->countVendorTypes();
            
        } else {
            $boxs = $this->dashbox();
            $member = '';
            $plans = [
                'plans' => Plan::pluck('name'),
                'total' => json_encode(array_values($planCounts)),
                'colors' => Plan::pluck('color')
            ];
            $categories = $this->countCategories();
            $types = $this->countWeddings();
        }

        // 
        $counts = User::whereHas('role', function ($query) {
            $query->where('id', 3);
        })->selectRaw('SUM(is_active) as active, COUNT(*) - SUM(is_active) as deactive')->first();
        
        $customers = json_encode([
            'active' => $counts->active,
            'deactive' => $counts->deactive,
        ]);
                
        // $customers = User::whereHas('role', function ($query) {
        //     $query->where('id', 3);
        // })->get();

        return view('dashboard.index', compact('boxs', 'plans', 'categories', 'types', 'customers', 'member'));
    }

    function dashbox() {
        return [
            [
                'role'  => ['admin'],
                'color' => 'primary',
                'name'  => 'Users',
                'total' => RoleGroup::whereIn('role_id', [1, 2])->count(),
                'icon'  => 'mdi mdi-account-tie fa-3x',
                'route' => route('users'),
            ],
            [
                'role'  => ['admin', 'user'],
                'color' => 'success',
                'name'  => 'Members',
                'total' => RoleGroup::where('role_id', 3)->count(),
                'icon'  => 'mdi mdi-wallet-membership fa-3x',
                'route' => route('customer'),
            ],
            [
                'role'  => ['admin', 'user'],
                'color' => 'danger',
                'name'  => 'Vendors',
                'total' => RoleGroup::where('role_id', 4)->count(),
                'icon'  => 'mdi mdi-account-group fa-3x',
                'route' => route('vendor-list'),
            ],
            [
                'role'  => ['admin', 'user'],
                'color' => 'warning',
                'name'  => 'Plan',
                'total' => Plan::count(),
                'icon'  => 'mdi mdi-cards-outline fa-3x',
                'route' => route('plans'),
            ],
        ];
    }

    function customerdashbox() {
        $userId = auth()->user()->id;
        $member = Member::where('customer_id', $userId)->first();
        $targetDate = Carbon::createFromDate($member->expiring_at);
        $today = Carbon::today();
        $remainingDays = $today->diffInDays($targetDate);
        return [
            [
                'role'  => ['customer'],
                'color' => 'primary',
                'name'  => 'Plan',
                'total' => $member->plan->name,
                'icon'  => 'mdi mdi-cards-outline fa-3x',
            ],
            [
                'role'  => ['customer'],
                'color' => 'primary',
                'name'  => 'Plan Expiry Date',
                'total' => $member->expiring_at,
                'icon'  => 'mdi mdi-calendar-month fa-3x',
            ],
            [
                'role'  => ['customer'],
                'color' => 'primary',
                'name'  => 'remaining days',
                'total' => $remainingDays,
                'icon'  => 'mdi mdi-av-timer fa-3x',
            ]
        ];
    }

    function countCategories() {
        $categoriesCount = Category::pluck('name', 'id')
        ->mapWithKeys(function ($categoryName, $categoryId) {
            return [$categoryName => 0];
        })
        ->merge(['Unknown' => 0])
        ->toArray();
        VendorDetail::select('categories')
            ->get()
            ->pluck('categories')
            ->flatten()
            ->countBy()
            ->each(function ($count, $categoryId) use (&$categoriesCount) {
                $category = Category::find($categoryId);
                $categoryName = $category ? $category->name : 'Unknown';
                $categoriesCount[$categoryName] += $count;
        });
        return collect($categoriesCount)->forget('Unknown')->toJson();
    }

    function countWeddings() {
        $typesCount = Type::pluck('name', 'id')
        ->mapWithKeys(function ($typeName, $typeId) {
            return [$typeName => 0];
        })
        ->merge(['Unknown' => 0])
        ->toArray();
        VendorDetail::select('types')
            ->get()
            ->pluck('types')
            ->flatten()
            ->countBy()
            ->each(function ($count, $typeId) use (&$typesCount) {
                $type = type::find($typeId);
                $typeName = $type ? $type->name : 'Unknown';
                $typesCount[$typeName] += $count;
        });
        return collect($typesCount)->forget('Unknown')->toJson();
    }

    function vendordashbox() {
        $userId = auth()->user()->id;
        $purchases = PurchaseHistory::where('vendor_id', $userId);

        // $earnings = $vendor->sum('subtotal');
        // $discounts = $vendor->sum('discount');
        // $total = $earnings - $discounts;
        $total = 0;
        foreach ($purchases->get() as $purchase) {
            $sum = $purchase->subtotal;
            $discountPercentage = $purchase->discount;
            $total += $sum - ($sum * ($discountPercentage / 100));
        }

        $customers = $purchases->count();
        return [
            [
                'role'  => ['vendor'],
                'color' => 'primary',
                'name'  => 'earnings',
                'total' => "RM$total",
                'icon'  => 'mdi mdi-currency-usd fa-3x',
            ],
            [
                'role'  => ['vendor'],
                'color' => 'primary',
                'name'  => 'customers',
                'total' => $customers,
                'icon'  => 'mdi mdi-account-cash-outline fa-3x',
            ],
        ];
    }

    function countVendorCategories() {

        $userId = auth()->user()->id;
        $vendorCategories = VendorDetail::where('vendor_id', $userId)->pluck('categories');

        $categoriesCount = Category::pluck('name', 'id')
            ->mapWithKeys(function ($categoryName, $categoryId) use (&$vendorCategories) {
                if (in_array($categoryId, json_decode($vendorCategories[0]))) {
                    return [$categoryName => 0];
                }
                return [];
            })
            ->merge(['Unknown' => 0])
        ->toArray();

        PurchaseHistory::where('vendor_id', $userId)
            ->select('categories')
            ->get()
            ->pluck('categories')
            ->flatten()
            ->countBy()
        ->each(function ($count, $categoryId) use (&$categoriesCount) {
            $category = Category::find($categoryId);
            $categoryName = $category ? $category->name : 'Unknown';
            $categoriesCount[$categoryName] += $count;
        });

        return collect($categoriesCount)->forget('Unknown')->toJson();

    }

    function countVendorTypes() {

        $userId = auth()->user()->id;
        $vendorTypes = VendorDetail::where('vendor_id', $userId)->pluck('types');

        $categoriesCount = Type::pluck('name', 'id')
            ->mapWithKeys(function ($typeName, $typeId) use (&$vendorTypes) {
                if (in_array($typeId, json_decode($vendorTypes[0]))) {
                    return [$typeName => 0];
                }
                return [];
            })
            ->merge(['Unknown' => 0])
        ->toArray();

        PurchaseHistory::where('vendor_id', $userId)
            ->select('type')
            ->get()
            ->pluck('type')
            ->flatten()
            ->countBy()
        ->each(function ($count, $typeId) use (&$categoriesCount) {
            $type = Type::find($typeId);
            $typeName = $type ? $type->name : 'Unknown';
            $categoriesCount[$typeName] += $count;
        });

        return collect($categoriesCount)->forget('Unknown')->toJson();

    }

}
