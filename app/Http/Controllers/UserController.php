<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)//: RedirectResponse
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->role==1)
                return redirect()->intended('dashboard');
            if($user->role==2)
                return redirect()->intended('USDashboard');
            if($user->role==3)
                return redirect()->intended('ifa-dashboard');
//            if(strtolower($request->username) == 'iiau'){
//                return redirect()->intended('ifa-dashboard');
//            }else
//            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
