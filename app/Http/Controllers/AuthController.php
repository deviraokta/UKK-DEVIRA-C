<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'peminjam', // Set default role to user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    
        public function login(Request $request)
        {
           $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
             $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role =='petugas') {
                return redirect()->route('petugas.dashboard');   
            } else {
                return redirect()->route('peminjam.dashboard');
            }
        }
            return back()->with('error', 'Login gagal. Pastikan username dan password benar.');
        }

            public function logout()
        {        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');    
    }
}
