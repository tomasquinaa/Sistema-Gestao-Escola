<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        //dd(Hash::make(12345));
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        //dd($request->all());
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],  $remember)) {

            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else  if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } else  if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else  if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Por favor, digite a senha e o e-mail correcto');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
