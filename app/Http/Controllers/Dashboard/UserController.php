<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Roles\Role;
use App\Models\Roles\RoleGroup;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TE;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $users = User::whereHas('role', function ($query) {
            $query->whereIn('id', [1,2]);
        })->get();
        $roles = Role::whereIn('id', [1,2])->get();
        $rolesbg = ['', 'primary', 'info', 'warning', 'success', 'dark', 'danger'];
        return view('dashboard.users.index', compact('users', 'roles', 'rolesbg'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            "email"     => "required|email:rfc,dns|unique:users,email",
            'role'      => 'required',
            'is_active' => 'required',
            'password'  => 'required|min:6',
        ]);
        
        $user = User::create($request->except(['_token', 'role']));
        RoleGroup::create([
            'user_id' => $user->id,
            'role_id' => $request->role,
        ]);
        
        return TE::alert('Success', 'success', 'User account created successfully');

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
            'update_password' => 'nullable|min:6',
            'update_role' => 'required',
            'update_is_active' => 'required',
        ],[],[
            'update_name' => 'name',
            'update_email' => 'email',
            'update_password' => 'password',
            'update_role' => 'role',
            'update_is_active' => 'status',
        ]);

        $tmp = [];
        foreach ($request->except('user') as $key => $value) {
            if ($key === 'update_password' && !$value) {
                $key = null;
                continue;
            }            
            $UpKey = str_replace('update_', '', $key);
            $tmp[$UpKey] = $value;
        }

        User::find($request->id)->update($tmp);

        RoleGroup::where('user_id', $request->id)->update(['role_id' => $request->update_role]);

        return TE::toast('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {        
        User::find($request->id)->delete();
        UserDetail::where('user_id', $request->id)->delete();
        RoleGroup::where('user_id', $request->id)->delete();

        return TE::toast('success', "User deleted successfully");
    }

    public function user_status(Request $request) {

        $user = User::find($request->id);
        $is_active = ($user->is_active) ? 0:1;
        $user->is_active = $is_active;
        $user->save();
        $msg = ($is_active) ? 'activated':'deactivated';

        return TE::toast('success', "User $msg successfully");
    }
    
    public function user_ban(Request $request) {
        $user = User::find($request->id);
        $is_ban = ($user->is_ban) ? 0:1;
        $user->is_ban = $is_ban;
        $user->save();
        $msg = ($is_ban) ? 'banned':'unbanned';

        return TE::alert('Success', 'success', "User $msg successfully");
    }
    
}
