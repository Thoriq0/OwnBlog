<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    // Login Page Showing
    public function showLoginPage(){
        return view('auth.login');
    }

    // Login Handle 
    public function loginHandle(Request $request){
        // dd($request->all());
        $credential = $request->only('email', 'password');
        $user = User::where('email', $credential['email'])->first();
        if($user->email && Hash::check($credential['password'], $user->password)){
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(['email' => 'Email atau Password Salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
