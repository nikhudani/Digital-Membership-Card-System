<?php

namespace App\Http\Controllers\Dashboard\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Vendor\Settings\Category;
use App\Models\Dashboard\Vendor\Settings\Location;
use App\Models\Dashboard\Vendor\Settings\Type;
use App\Models\Dashboard\Vendor\VendorDetail;
use App\Models\User;
use Illuminate\Http\Request;
use TE;

class DetailsController extends Controller
{

    public function index() {

        $details = VendorDetail::all();
        
        $vendors = User::whereHas('role', function ($query) {
            $query->where('id', 4);
        })
        ->whereNotIn('id', function ($query) {
            $query->select('vendor_id')->from('vendor_details');
        })
        ->get();
        
        
        $types = Type::all();
        $categories = Category::all();
        $locations = Location::all();

        return view('dashboard.vendor.details', compact('details', 'vendors', 'types', 'categories', 'locations'));

    }

    public function store(Request $request) {

        // $request->validate([
        //     'vendor_id'  => 'required',
        //     'types[]'      => 'required|array|min:1',
        //     'categories[]' => 'required|array|min:1',
        //     'locations[]'  => 'required|array|min:1',
        // ], [], [
        //     'vendor_id'  => 'vendor',
        //     'types[]'      => 'type',
        //     'categories[]' => 'category',
        //     'locations[]'  => 'location',
        // ]);

        VendorDetail::create($request->all());

        return TE::toast('success', 'Vendor details created successfully');

    }
    
    public function update(Request $request) {

        // $request->validate([
        //     'update_types[]'      => 'required|array|min:1',
        //     'update_categories[]' => 'required|array|min:1',
        //     'update_locations[]'  => 'required|array|min:1',
        // ], [], [
        //     'update_types[]'      => 'type',
        //     'update_categories[]' => 'category',
        //     'update_locations[]'  => 'location',
        // ]);

        $tmp = [];
        foreach ($request->except('id') as $key => $value) {
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        VendorDetail::find($request->id)->update($tmp);

        return TE::toast('success', 'Vendor details update successfully');

    }
    
    public function destroy(Request $request) {
        VendorDetail::where('vendor_id', $request->id)->delete();        
        return TE::toast('success', 'Vendor details deleted successfully');
    }
}
