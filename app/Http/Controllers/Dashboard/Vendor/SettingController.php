<?php

namespace App\Http\Controllers\Dashboard\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Vendor\Settings\Category;
use App\Models\Dashboard\Vendor\Settings\Location;
use App\Models\Dashboard\Vendor\Settings\Type;
use Illuminate\Http\Request;
use TE;

class SettingController extends Controller
{

    public function index() {
        $types = Type::all();
        $categories = Category::all();
        $locations = Location::all();
        return view('dashboard.vendor.settings', compact('types', 'categories', 'locations'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        if ($request->vendor == 'type') {
            Type::create(['name' => $request->name]);
        } elseif ($request->vendor == 'category') {
            Category::create(['name' => $request->name]);
        } elseif ($request->vendor == 'location') {
            Location::create(['name' => $request->name]);
        } else {
            return TE::alert('Error', 'error', "Error while adding vendor $request->vendor!");
        }

        return TE::toast('success', "Vendor $request->vendor added successfully");

    }
    
    public function update(Request $request) {
        $request->validate([
            'update_name' => 'required'
        ]);

        if ($request->vendor == 'type') {
            Type::find($request->id)->update(['name' => $request->update_name]);
        } elseif ($request->vendor == 'category') {
            Category::find($request->id)->update(['name' => $request->update_name]);
        } elseif ($request->vendor == 'location') {
            Location::find($request->id)->update(['name' => $request->update_name]);
        } else {
            return TE::alert('Error', 'error', "Error while updating vendor $request->vendor!");
        }

        return TE::toast('success', "Vendor $request->vendor updated successfully");
    }
    
    public function destroy(Request $request) {

        if ($request->vendor == 'type') {
            Type::find($request->id)->delete();
        } elseif ($request->vendor == 'category') {
            Category::find($request->id)->delete();
        } elseif ($request->vendor == 'location') {
            Location::find($request->id)->delete();
        } else {
            return TE::alert('Error', 'error', "Error while deleting vendor $request->vendor!");
        }

        return TE::toast('success', "Vendor $request->vendor deleted successfully");
    }
    
}
