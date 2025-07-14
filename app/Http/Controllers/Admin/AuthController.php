<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        // Check if user exists and is suspended
        $user = User::where('email', $credentials['email'])->first();
        if ($user && !$user->is_active) {
            return back()->withErrors([
                'email' => 'Your account has been suspended. Please contact the administrator.'
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = auth()->user();
            $role = ucfirst($user->role); // Capitalize role
            $name = $user->name;

            return redirect()
                ->route('admin.dashboard')
                ->with('success', "Welcome back {$role} {$name}");
        }


        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
