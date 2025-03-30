<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'id_user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['id_user' => $credentials['id_user'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            
            // Store user data in session
            session([
                'id_user' => $user->id_user,
                'role' => $user->role,
                'name' => $user->name, // Assuming user has a 'name' field
            ]);

            // Authentication successful, redirect based on role
            return match ($user->role) {
                'admin' => redirect('/admin'),
                'student' => redirect('/student'),
                'staff' => redirect('/staff'),
                'kaprodi' => redirect('/kaprodi'),
                default => redirect('/'),
            };
        }

        // Authentication failed, redirect back with error
        return redirect()->back()
            ->withInput($request->only('id_user', 'remember'))
            ->withErrors(['id_user' => 'These credentials do not match our records.']);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}