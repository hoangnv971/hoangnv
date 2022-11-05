<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        if($request->post()){
            $credentials = $request->only('email', 'password');
 
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard');
            }
        }
        return view('login');
    }
}
