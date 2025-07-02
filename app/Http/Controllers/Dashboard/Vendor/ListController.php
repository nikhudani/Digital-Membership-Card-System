<?php

namespace App\Http\Controllers\Dashboard\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Roles\RoleGroup;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TE;

class ListController extends Controller
{
    
    public function index() {

        $vendors = User::whereHas('role', function ($query) {
            $query->where('id', 4);
        })->get();

        return view('dashboard.vendor.list', compact('vendors'));

    }

    public function store(Request $request) {

        $request->validate([
            'name'          => 'required',
            'organization'  => 'required',
            'phone_number'  => 'required',
            'email'         => 'required|email:rfc,dns|unique:users,email',
            'password'      => 'required|min:6',
        ], [], [
            'organization'  => 'business name',
            'phone_number'  => 'phone no',
        ]);
                
        $request->merge(['is_active' => ($request->is_active) ? true:false]);

        $user = User::create($request->all());
        RoleGroup::create([
            'user_id' => $user->id,
            'role_id' => 4,
        ]);
        $request->merge([ 'user_id' => $user->id ]);

        UserDetail::create($request->all());
        
        return TE::alert('Success', 'success', 'Vendor account created successfully');

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'update_name'         => 'required',
            'update_email'        => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore($request->id, 'id'),
            ],
            'update_organization' => 'nullable|min:6',
            'update_phone_number' => 'required',
            'update_password'     => 'nullable|min:6',
        ],[],[
            'update_name'         => 'name',
            'update_email'        => 'email',
            'update_password'     => 'password',
            'update_organization' => 'business name',
            'update_phone_number' => 'phone no',
        ]);

        $tmp = [];
        foreach ($request->except('id') as $key => $value) {
            if ($key === 'update_password' && !$value) {
                $key = null;
                continue;
            }            
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        User::find($request->id)->update($tmp);

        UserDetail::find($request->id)->update($tmp);

        return TE::toast('success', 'Vendor updated successfully');

    }

    public function destroy(Request $request) {
        User::find($request->id)->delete();
        UserDetail::where('user_id', $request->id)->delete();
        RoleGroup::where('user_id', $request->id)->delete();
        return TE::toast('success', 'Vendor deleted successfully');
    }

}
