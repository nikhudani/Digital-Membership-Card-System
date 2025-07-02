<?php

namespace App\Http\Controllers\Dashboard\Customer;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\PurchaseHistory;
use App\Models\Dashboard\Vendor\Settings\Type;
use App\Models\Dashboard\Vendor\VendorDetail;
use App\Models\User;
use Illuminate\Http\Request;
use TE;

class PurchaseHistoryController extends Controller
{
    
    public function index() {

        $customers = Member::all();
        $vendors = VendorDetail::all();
        $user = auth()->user();
        $types = [];
        $locations = [];
        $categories = [];
        if ($user->hasRole(['Customer'])) {
            $purchases = PurchaseHistory::where('customer_id', $user->id)->get();
        } elseif ($user->hasRole(['vendor'])) {
            $purchases = PurchaseHistory::where('vendor_id', $user->id)->get();
            $vendor = VendorDetail::where('vendor_id', $user->id)
                ->select('types', 'categories', 'locations')
                ->get()
                ->toJson();
            $wedOpts = json_decode($vendor)[0];
            $types = $wedOpts->types;
            $locations = $wedOpts->locations;
            $categories = $wedOpts->categories;
        } else {
            $purchases = PurchaseHistory::all();
        }        

        return view('dashboard.membership.purchases', compact('customers', 'vendors', 'purchases', 'types', 'locations', 'categories'));

    }

    public function vendordetails(Request $request) {

        $details = VendorDetail::where('vendor_id', $request->id)->get();

        return response()->json($details);

    }

    public function store(Request $request) {
        PurchaseHistory::create($request->all());
        return TE::toast('success', 'Purchase added successfully');
    }

    public function update(Request $request) {
        $tmp = [];
        foreach ($request->except('id') as $key => $value) {
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }
        PurchaseHistory::find($request->id)->update($tmp);
        return TE::toast('success', 'Purchase updated successfully');
    }

    public function destroy(Request $request) {
        PurchaseHistory::find($request->id)->delete();
        return TE::toast('success', 'Purchase deleted successfully');
    }
}
