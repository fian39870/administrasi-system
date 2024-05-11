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

    public function home(){
        return view('home');
    }
    public function showLogin(){
        return view('login');
    }
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->attempt($validate)){
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('Email dan Password Salah');
        }
    }
}
