<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
            'regnumber' => ['required', 'string', 'max:50', 'unique:users'],
            'campus' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'regnumber' => $request->regnumber,
            'campus' => $request->campus,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        // Insert into food_taken
        DB::table('food_taken')->insert([
            'student_id' => $user->id,
            'payment_amount' => 0,
            'meal_cost' => 0,
            'times_taken' => 0,
            'times_remaining' => 0,
        ]);

        // Generate QR code 
        $qrData = url("/confirm_meal/{$user->id}");
        $qrPath = "qrcodes/{$user->id}_qrcode.svg";
        QrCode::format('svg')
            ->size(200)
            ->generate($qrData, public_path($qrPath));
        $user->qr_code = $qrPath;
        $user->save();

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
