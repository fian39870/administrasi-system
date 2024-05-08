<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Coba untuk mengautentikasi pengguna
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Jika autentikasi berhasil
        return redirect()->intended('/dashboard');
    }

    // Jika autentikasi gagal, kembalikan dengan pesan error
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

}
