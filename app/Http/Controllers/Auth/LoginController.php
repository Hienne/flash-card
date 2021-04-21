<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home'); 
        }
        else {
            return back()->with('status', 'Đăng nhập không thành không. Tên tài khoản hoặc mật khẩu không chính xác.');
        }
        
    }
}
