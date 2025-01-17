<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.auth.login');
    }

    public function loginUser()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home')->with(['success' => 'Hi ' . auth()->user()->name]);
            }
        }

        return back()->with([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function myProfile()
    {
        return view('auth.my-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        Auth::user()->update($request->only('name', 'email'));

        return back()->with('success', 'Profile updated successfully.');
    }

    public function logout()
    {
        if (Auth::user()->role == 'admin') {
            Auth::logout();
            return redirect()->route('login');
        } else {
            Auth::logout();
            return redirect()->route('home');
        }
    }
}
