<?php

namespace App\Http\Controllers\Dashboard\Membership;

use App\Http\Controllers\Controller;
use App\Mail\VcardMail;
use App\Models\Dashboard\Customer\VirtualCard;
use App\Models\Dashboard\Membership\Details\SocialLink;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\Plan;
use App\Models\Dashboard\Setting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TE;

class QrCodeController extends Controller
{
    
    public function index() {
        
        $plans = Plan::where('is_active', true)->get();
        return view('dashboard.membership.management.qrcode', compact('plans'));
    }

    public function update_contact(Request $request) {
        UserDetail::find($request->id)->update($request->all());
        return TE::toast('success', 'Contact updated successfully');
    }
    
    public function social_link(Request $request) {
        // SocialLink::find($request->id)->update($request->all());
        SocialLink::updateOrInsert(
            ['customer_id' => $request->id],
            $request->except('id')
        );
        return TE::toast('success', 'Social Links updated successfully');
    }
    
    public function qr_size(Request $request) {
        Member::find($request->id)->update($request->all());
        return TE::toast('success', 'QR size updated successfully');
    }
    
    public function theme(Request $request) {
        Member::find($request->id)->update($request->all());
        return TE::toast('success', 'Theme updated successfully');
    }

    public function sendEmail(Request $request) {

        $request->validate([
            'email_subject' => 'required',
            'email_message' => 'required',
        ], [], [
            'email_subject' => 'subject',
            'email_message' => 'message',
        ]);
        
        $settings = Setting::all();
        $mailConfs = [];
        $defMailConfs = [ 'mail_encryption', 'mail_from_address', 'mail_host', 'mail_mailer', 'mail_password', 'mail_port', 'mail_username' ];

        foreach ($settings as $key => $value) {
            if (str_contains($value->name, 'mail_')) {
                if ($value->value) {
                    $mailConfs[] = $value->value;
                }
            }
        }

        if ( count($defMailConfs) != count($mailConfs) ) {            

            return TE::alert('Error', 'error', 'Email configuration missing!', route('system'));

        }

        $member = VirtualCard::with(['customer'])->where('customer_id', $request->id)->first();

        $body = [
            'vcardname' => $member->name,
            'vcardlink' => route('slug', $member->slugurl),
            'message'   => $request->email_message,
        ];

        Mail::to($member->customer->email)->send(new VcardMail($request->email_subject, $body));

        return TE::toast('success', 'Email has been sent!');
    }
    
}
