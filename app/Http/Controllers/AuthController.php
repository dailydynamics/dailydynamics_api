<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function forgotpswd()
    {
        return view('auth.forgot');
    }
    public function loginPost(Request $request)
    {
        return redirect()->route('home');
    }
    public function forgotPost(Request $request)
    {
        return "FORGOT POST";
    }
}
