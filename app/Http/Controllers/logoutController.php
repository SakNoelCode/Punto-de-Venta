<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class logoutController extends Controller
{
    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
