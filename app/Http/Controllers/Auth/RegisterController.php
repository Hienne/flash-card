<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {

        // dd($request);
        $user = $this->validate($request, [
            'name' => 'required|max:255',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create($user);

        return redirect()->route('dashboard');
    }

    public function dashboard() {
        return view('layouts.dashboard');
    }
}
