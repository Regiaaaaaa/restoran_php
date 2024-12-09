<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'nullable|in:admin,staff', // Role bersifat opsional
    ]);

    User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}


    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login pengguna
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Logged in successfully');
        }

        throw ValidationException::withMessages([
            'username' => 'Where your name?',
        ]);
    }

    // Menangani logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
