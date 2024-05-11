<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    public function showLogin(){
        return view('login');
    }
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email', $validate['email'])->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($validate['password'], $user->password)) {
            // Attempt to log in the user
            if (Auth::login($user)) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('success', 'Selamat, Anda berhasil login.');
            }
        }
        else{
            return redirect()->back()->with('Email dan Password Salah');
        }
    }
}
