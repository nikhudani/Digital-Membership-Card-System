<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use TE;

class AccountController extends Controller
{
    public function index() {
        // $myaccount = User::find(auth()->user()->id);
        $myaccount = auth()->user();
        // $myaccount = User::with('details')->find(auth()->user()->id);
        // dd($myaccount->role);

        return view('dashboard.settings.account', compact('myaccount'));
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            "email"         => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore(auth()->user()->id, 'id'),
            ],
            'gender'        => 'required',
            'organization'  => 'required',
            'phone_number'  => 'required|numeric',
            'address'       => 'required',
            'city'          => 'required',
            'state'         => 'required',
            'zip'           => 'required|numeric',
            'country'       => 'required',
        ]);
        
        $arr = $request->except(['_token', 'name', 'email']);
        auth()->user()->details->updateOrCreate(
            ['user_id' => auth()->user()->id], 
            $arr
        );
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return TE::alert('Success', 'success', 'Account Updated successfully');
    }

    public function reset_password(Request $request) {
        $request->validate([
            'current_password'      => 'required|current_password',
            "password"              => "required|string|min:8|confirmed",
            'password_confirmation' => 'required',
        ]);
        $user = auth()->user();
        $user->update([
            'password' => $request->password
        ]);

        Auth::logout();
        return TE::alert('Success', 'success', 'Account password updated successfully');
    }

    public function upload(Request $request) {
        $request->validate([
            'p_picture' => 'required|file|mimes:png,jpg,jpeg,svg|max:5120',
        ]);

        $file = $request->file('p_picture');
        $file_name = time().auth()->user()->id.$file->getClientOriginalName();
        $file->move(public_path('images/user'), $file_name);
        $user = auth()->user()->details;
        $user->updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'image' => $file_name ]
        );

        return TE::alert('Success', 'success', 'Profile picture uploaded successfully');
    }

}
