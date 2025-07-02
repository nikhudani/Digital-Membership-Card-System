<?php

namespace App\Http\Controllers;

use App\Models\Dashboard\Customer\VirtualCard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SlugController extends Controller
{

    public function index($slug = null) {
        
        if (!$slug) {
            return redirect('/'); 
        }

        $vCard = VirtualCard::where(['slugurl' => $slug, 'is_active' => true])->with(['customer', 'plan', 'social']);

        if ($vCard->count() < 1) {
            return redirect('/'); 
        }

        // return response($vCard->first());
        $vcards = $vCard->first();

        // dd($vcards);

        return view('slug', compact('vcards'));
        
    }
    // Add a new method to the SlugController
    public function share(Request $request)
    {
        // Get the shared link
        $link = $request->input('link');

        // Redirect to the sharing URL
        return Redirect::away($link);
    }

}
