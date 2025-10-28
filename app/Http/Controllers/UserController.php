<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($user) {
            return redirect('/')->with('success', 'Registration successful');
        }

        return redirect('/register')->with('error', 'Registration failed');
    }

   public function checkLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // ✅ Attempt login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // 🛑 Blocked user check
        if (isset($user->status) && $user->status === 'blocked') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your account has been blocked by the admin.'
            ])->withInput();
        }

        // ✅ Redirect based on role
        if (isset($user->role) && (int)$user->role === 1) {
            // Admin user
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Welcome back, Admin!');
        } else {
            // Normal customer user — redirect to homepage URL
            return redirect('/')->with('success', 'Login successful!');
        }
    }

    // ❌ Failed authentication
    return back()->withErrors([
        'email' => 'Invalid credentials. Please check your email or password.'
    ])->withInput();
}
}