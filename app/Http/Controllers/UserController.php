<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if ( Auth::user()->role === 'admin') {
            return redirect(route('admin.dashboard'));
        } elseif ( Auth::user()->role === 'chef') {
            return redirect(route('chef.dashboard'));
        } else{
            return view('layouts.homepage');
        }
    }
}
