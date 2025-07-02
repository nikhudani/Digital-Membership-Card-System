<?php

namespace App\Http\Controllers\Dashboard\Membership;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Membership\Plan;
use Illuminate\Http\Request;
use TE;

class PlanController extends Controller
{
    
    public function index() {
        $plans = Plan::orderBy('price', 'asc')->get();
        return view('dashboard.membership.plan', compact('plans'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'      => 'required',
            'image'     => 'required|file|mimes:png',
            'color'     => 'required',
            'price'     => 'required',
            'is_active' => 'required',
        ], [], [
            'is_active' => 'status',
        ]);

        $file = $request->file('image');
        $file_name = trim($request->name);
        $file->move(public_path('images/cards'), "$file_name.png");

        Plan::create($request->except('image'));

        return TE::toast('success', 'Plan create successfully');
    }
    
    public function update(Request $request) {
        $request->validate([
            'update_name'      => 'required',
            'update_color'     => 'required',
            'update_image'     => 'file|mimes:png',
            'update_price'     => 'required',
            'update_is_active' => 'required',
        ], [], [
            'update_name'      => 'name',
            'update_color'     => 'color',
            'update_image'     => 'image',
            'update_price'     => 'price',
            'update_is_active' => 'status',
        ]);

        $tmp = [];
        foreach ($request->except('update_image') as $key => $value) {
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        $file = $request->file('update_image');
        if ($file) {
            $file_name = trim($request->update_name);
            $file->move(public_path('images/cards'), "$file_name.png");
        }

        Plan::find($request->id)->update($tmp);

        return TE::toast('success', 'Plan updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {        
        Plan::find($request->id)->delete();

        return TE::toast('success', "Plan deleted successfully");
    }

    public function status(Request $request) {

        $plan = Plan::find($request->id);
        $is_active = ($plan->is_active) ? 0:1;
        $plan->is_active = $is_active;
        $plan->save();
        $msg = ($is_active) ? 'activated':'deactivated';

        return TE::toast('success', "Plan $msg successfully");
    }
    
}
