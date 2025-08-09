<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    /**
     * Show the settings page
     */
    public function index()
    {
        return view('settings');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'new_password_confirmation' => ['required', 'string'],
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password_confirmation.required' => 'Password confirmation is required.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Check if new password is different from current password
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'New password must be different from current password.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', 'Password updated successfully!');
    }

    /**
     * Update user passkey
     */
    public function updatePasskey(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_passkey' => ['required', 'string', 'min:4', 'max:10', 'regex:/^[0-9]+$/', 'confirmed'],
            'new_passkey_confirmation' => ['required', 'string'],
        ], [
            'new_passkey.required' => 'New passkey is required.',
            'new_passkey.min' => 'Passkey must be at least 4 digits.',
            'new_passkey.max' => 'Passkey cannot exceed 10 digits.',
            'new_passkey.regex' => 'Passkey must contain only numbers.',
            'new_passkey.confirmed' => 'Passkey confirmation does not match.',
            'new_passkey_confirmation.required' => 'Passkey confirmation is required.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        // Check if new passkey is different from current passkey
        if ($user->passkey === $request->new_passkey) {
            return back()->withErrors(['new_passkey' => 'New passkey must be different from current passkey.'])->withInput();
        }

        // Update passkey
        $user->passkey = $request->new_passkey;
        $user->save();

        return back()->with('passkey_success', 'Passkey updated successfully!');
    }
} 