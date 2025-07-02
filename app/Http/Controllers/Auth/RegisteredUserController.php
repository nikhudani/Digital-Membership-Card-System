<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dashboard\Membership\Member;
use App\Models\Dashboard\Membership\Plan;
use App\Models\UserDetail;
use App\Models\Roles\RoleGroup;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $plans = Plan::where('is_active', true)->get(); // Assuming Plan model exists and has 'is_active' column
        return view('auth.register', compact('plans'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => 1, // Set is_active to 1
        ]);
        // Assuming UserDetail model exists and has 'phone_number' column
        UserDetail::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
        ]);

        // Automatically assign the user to the "Customer" role
        RoleGroup::create([
            'user_id' => $user->id,
            'role_id' => 3, // Assuming ID 3 corresponds to the "Customer" role
        ]);

    $memberId = $this->generateMemberId(); // Implement this method to generate a unique member ID

    $expiryDate = now()->addYear()->format('Y-m-d'); // Expiry date set to one year from now

    Member::create([
        'member_id' => $memberId,
        'customer_id' => $user->id,
        'plan_id' => 4, // Assuming "Silver" plan has an ID of 4
        'expiring_at' => $expiryDate,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}
protected function generateMemberId()
{
    do {
        $id1 = 606;
        $id2 = rand(100, 999);
        $memberId = "WM-$id1-$id2";
        // Check if the generated member_id already exists
    } while (Member::where('member_id', $memberId)->exists());

    return $memberId;
}
}