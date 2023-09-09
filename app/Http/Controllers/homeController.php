<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return view('welcome');
        }
        return view('panel.index');
    }

}
