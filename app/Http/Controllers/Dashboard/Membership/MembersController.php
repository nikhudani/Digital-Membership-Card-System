<?php

namespace App\Http\Controllers\Dashboard\Membership;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\Plan;
use App\Models\Roles\RoleGroup;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TE;

class MembersController extends Controller
{
    
    public function index() {        
        $members = Member::all();
        $plans = Plan::where('is_active', true)->get();
        return view('dashboard.membership.members', compact('members', 'plans'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email:rfc,dns|unique:users,email',
            'password'      => 'required',
            'plan'          => 'required',
            'is_active'     => 'required',
            'phone_number'  => 'required',
            'expiring_at'   => 'required',
        ], [], [
            'is_active'     => 'status',
            'phone_number'  => 'mobile',
            'expiring_at'   => 'expiry date',
        ]);

        $customer = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
            'is_active'     => $request->is_active,
        ]);

        RoleGroup::create([
            'user_id' => $customer->id,
            'role_id' => 3,
        ]);

        UserDetail::create([
            'user_id'       => $customer->id,
            'phone_number'  => $request->phone_number,
        ]);

        Member::create([
            'member_id'     => $this->memberId(),
            'customer_id'   => $customer->id,
            'plan_id'       => $request->plan,
            'expiring_at'   => $request->expiring_at,
        ]);


        return TE::toast('success', 'Customer create successfully');
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'update_name' => 'required',
            'update_email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore($request->id, 'id'),
            ],
            'update_password' => 'nullable|min:8',
            'update_plan' => 'required',
            'update_is_active' => 'required',
            'update_phone_number' => 'required',
            'update_expiring_at' => 'required',
        ], [], [
            'update_name' => 'name',
            'update_email' => 'email',
            'update_password' => 'password',
            'update_plan' => 'plan',
            'update_is_active' => 'status',
            'update_phone_number' => 'mobile',
            'update_expiring_at' => 'expiry date',
        ]);

        $tmp = [];
        foreach ($request->except(['id']) as $key => $value) {
            if ($key === 'update_password' && !$value) {
                $key = null;
                continue;
            }            
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        User::find($request->id)->update($tmp);
        UserDetail::find($request->id)->update([
            'phone_number' => $request->update_phone_number,
        ]);
        Member::find($request->id)->update([
            'plan_id' => $request->update_plan,
            'expiring_at' => $request->update_expiring_at,
        ]);

        return TE::toast('success', 'Customer updated successfully');
        // return response($tmp);
    }

    public function destroy(Request $request) {
        Member::find($request->id)->delete();
        User::find($request->id)->delete();
        UserDetail::where('user_id', $request->id)->delete();
        return TE::toast('success', 'Customer deleted successfully');
    }

    public function memberId() {
        $id1 = rand(111, 999);
        $id2 = rand(111, 999);
        $wm = "WM-$id1-$id2";
        $member = Member::where('member_id', $wm)->count();
        if ($member > 0) {
            return $this->memberId();
        }
        return $wm;
    }

}
