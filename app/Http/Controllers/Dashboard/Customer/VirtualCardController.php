<?php

namespace App\Http\Controllers\Dashboard\Customer;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Customer\VirtualCard;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TE;

class VirtualCardController extends Controller
{
    
    public function index() {

        $customers = User::whereHas('role', function ($query) {
            $query->whereIn('id', [3]);
        })->get();

        if (auth()->user()->hasRole(['Customer'])) {
            $vcards = VirtualCard::where('customer_id', auth()->user()->id)->with(['customer', 'plan', 'social'])->get();
        } else {
            $vcards = VirtualCard::with(['social'])->get();
        }

        $plans = Plan::all();
        
        return view('dashboard.membership.virtualcard', compact('customers', 'vcards', 'plans'));
        
    }

    public function store(Request $request) {

        $request->validate([
            'slugurl'       => 'required|unique:virtual_cards,slugurl',
            'name'          => 'required',
            'customer_id'   => 'required',
        ], [], [
            'slugurl'       => 'slug url',
            'cardname'      => 'card name',
            'customer_id'   => 'customer',
        ]);

        $request->merge(['is_active' => ($request->is_active) ? true:false]);
        
        VirtualCard::create($request->all());

        return TE::toast('success', 'Virtual Card created successfully');

    }
    
    public function status(Request $request) {

        $vCard = VirtualCard::find($request->id);
        $is_active = ($vCard->is_active) ? 0:1;
        $vCard->is_active = $is_active;
        $vCard->save();
        $msg = ($is_active) ? 'activated':'deactivated';
        return TE::toast('success', "Virtual Card $msg successfully");

    }

    public function update(Request $request) {

        $request->validate([
            'update_name' => 'required',
            'update_slugurl' => [
                'required',
                Rule::unique('virtual_cards', 'slugurl')->ignore($request->id, 'id'),
            ],
            'update_customer_id' => 'required',
        ],[],[
            'update_name' => 'card name',
            'update_slugurl' => 'slug url',
            'update_customer_id' => 'customer',
        ]);

        $tmp = [];
        foreach ($request->except('id') as $key => $value) {
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        VirtualCard::find($request->id)->update($tmp);

        return TE::toast('success', 'Virtual Card updated successfully');

    }
    
    public function plan(Request $request) {
        Member::find($request->id)->update($request->all());
        return TE::toast('success', 'Plan updated successfully');
    }
    
    public function destroy(Request $request) {
        VirtualCard::find($request->id)->delete();
        return TE::toast('success', 'Virtual Card deleted successfully');
    }
    
}
