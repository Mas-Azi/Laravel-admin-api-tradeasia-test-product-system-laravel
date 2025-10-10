<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Tampilkan form register
    public function register()
    {
        return view('auth.register');
    }

    // Simpan data register
    public function register_save(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin' // set level admin
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully.');
    }

    // Tampilkan form login
    public function login()
    {
        return view('auth.login');
    }

    // Login action dengan cek level
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        // Cek level user
        $user = Auth::user();
        if ($user->level !== 'Admin') {
            Auth::logout(); // logout user non-admin
            return redirect()->route('login')
                ->withErrors(['email' => 'Unauthorized: You are not an admin.']);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // // Profile
    // public function profile()
    // {
    //     return view('profile');
    // }
}
