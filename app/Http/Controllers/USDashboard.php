<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class USDashboard extends Controller
{
    function get(Request $request){
        $user = Auth::user();
        if ($user->username == 'iiau'){
            return redirect()->intended('ifa-dashboard');
        }else {
            $request->session()->put('year', date('Y'));
            return view('USDashboard', ['user' => $user]);
        }
    }
}
