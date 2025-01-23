<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function registerUser()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

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

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $fields = $request->only('name', 'email');
        $fields['password'] = bcrypt($request->password);
        $fields['role'] = 'user';

        Auth::login($user = User::create($fields));

        return redirect()->route('home')->with(['success' => 'Hi ' . auth()->user()->name]);
    }

    public function myProfile()
    {
        return view('auth.my-profile');
    }

    public function adminMyProfile()
    {
        return view('admin.auth.my-profile');
    }

    public function adminUpdateProfile(Request $request)
    {
        //update name, email, jika ada password update password juga

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $fields = $request->only('name', 'email');

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $fields['password'] = bcrypt($request->password);
        }

        Auth::user()->update($fields);

        return back()->with('success', 'Profile updated successfully.');
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
            return redirect()->route('admin.login');
        } else {
            Auth::logout();
            return redirect()->route('home');
        }
    }
}