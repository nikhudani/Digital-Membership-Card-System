<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Setting;
use Illuminate\Http\Request;
use TE;

class SystemController extends Controller
{
    
    public function index() {
        
        $getSettings = Setting::all();
        return view('dashboard.settings.system', compact('getSettings'));
    }

    public function logo(Request $request) {
        $request->validate([
            'logo' => 'required|file|mimes:png,jpg,jpeg,svg|max:5120',
        ]);

        $file = $request->file('logo');
        $file_name = 'logo.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/brand'), $file_name);
        
        Setting::updateOrCreate(
            [ 'name' => 'logo' ],
            [ 'value' => $file_name ],
        );

        return TE::alert('Success', 'success', 'Logo uploaded successfully');
    }

    public function favicon(Request $request) {
        $request->validate([
            'favicon' => 'required|file|mimes:ico,image/x-icon',
        ]);

        $file = $request->file('favicon');
        $file_name = 'favicon.ico';
        $file->move(public_path('images/brand'), $file_name);
        
        return TE::alert('Success', 'success', 'Favicon uploaded successfully');
    }

    public function brand(Request $request) {

        $request->validate([
            'title' => 'required'
        ]);

        foreach ($request->all() as $key => $value) {
            if ($value) {
                Setting::updateOrCreate(
                    [ 'name' => $key ],
                    [ 'value' => $value ],
                );
            }
        }

        return TE::alert('Success', 'success', 'Brand updated successfully');
    }
    
    public function mailsetup(Request $request) {

        $request->validate([
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required|email',
        ],[],[
            'mail_mailer' => 'mailer',
            'mail_host' => 'host',
            'mail_port' => 'port',
            'mail_username' => 'username',
            'mail_password' => 'password',
            'mail_encryption' => 'encryption',
            'mail_from_address' => 'from address',
        ]);

        foreach ($request->all() as $key => $value) {
            if ($value) {
                Setting::updateOrCreate(
                    [ 'name' => $key ],
                    [ 'value' => $value ],
                );
            }
        }

        return TE::alert('Success', 'success', 'System email updated successfully');
    }
}
