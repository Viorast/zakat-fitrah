<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Muzakki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     // Jika ingin menggunakan sanctum untuk API
    //     $this->middleware('auth:sanctum')->except(['register', 'login']);

    //     // ATAU jika untuk web authentication biasa
    //     $this->middleware('auth')->except(['register', 'login', 'showLoginForm', 'showRegisterForm']);
    // }

    public function showLoginForm()
    {
        return view('auth.user.LoginPage');
    }

    public function showRegisterForm()
    {
        return view('auth.user.RegisterPage');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('landingPage');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|string|email|max:255|unique:muzakkis',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $muzakki = Muzakki::create([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($muzakki);

        return redirect('/dashboard');
    }

   

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();   
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/muzakki/login');
    }
}
