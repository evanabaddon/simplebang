<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request){
      if(Auth::check()){
        return redirect('/');

      }
      return view('auth.login');
    }

    public function auth(Request $request){
      $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
                'remember' => 'nullable|boolean',
            ],
          [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
            'remember.boolean' => 'Data autentikasi tidak valid.'
          ]
        );

        $creds  =  $request->only('username','password');
        $remember   =  $request->input('remember') ? $request->input('remember') : "0";

        if (Auth::viaRemember()) {
           //
           return redirect('/dashboard');
         }

        if(Auth::attempt(['username' => $request->input('username') , 'password' => $request->input('password')] , $remember)){
          return redirect('/dashboard');
        }
        return redirect()->route('auth.index')->withErrors(['error' => 'Login gagal, periksa kembali username dan password anda.']);

    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return redirect()->route('auth.index');
    }
}
