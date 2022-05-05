<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended(url('/admin'));
    }
}
