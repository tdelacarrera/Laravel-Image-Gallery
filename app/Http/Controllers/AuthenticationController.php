<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    public function register(){
        return view('auth.register');
    }

    public function login(){
        return view('auth.login');
    }

}
