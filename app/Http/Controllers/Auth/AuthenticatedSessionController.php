<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'regnumber' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('regnumber', $request->regnumber)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Redirect based on user role
            switch ($user->role) {
                case 'student':
                    return redirect()->route('dashboard');
                case 'work':
                    return redirect()->route('work-dashboard');
                case 'manager':
                    return redirect()->route('manager-dashboard');
                case 'admin':
                    return redirect()->route('admin-dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'regnumber' => 'Invalid credentials.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
