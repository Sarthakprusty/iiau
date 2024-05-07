<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class USDashboard extends Controller
{
    function get(Request $request){
        $user = Auth::user();
        if($user->role==1)
            return redirect()->intended('dashboard');
        if($user->role==3)
            return redirect()->intended('ifa-dashboard');
        else {
            $request->session()->put('year', date('Y'));
            $Year = date('Y');

            $reports = Report::where('year', $Year)
                ->whereHas('statuses', function ($query) {
                    $query->whereIn('status_id', [2,3])
                    ->where('active', 1)
                    ->where('section_id', Auth::user()->section_id);
                })
                ->get();
            return view('USDashboard', ['user' => $user,'data'=>$reports]);
        }
    }

    function find(Request $request){
        $user = Auth::user();
        if($user->role==1)
            return redirect()->intended('dashboard');
        if($user->role==3)
            return redirect()->intended('ifa-dashboard');
        else {
            $Year = $request->get('report_year');
            Log::debug('Report year is:{report_year}', ['report_year' => $Year]);
            $request->session()->put('year', $Year);

            $reports = Report::where('year', $Year)
                ->whereHas('statuses', function ($query) {
                    $query->whereIn('status_id', [2,3])
                    ->where('active', 1)
                    ->where('section_id', Auth::user()->section_id);
                })
                ->get();
            return view('USDashboard', ['user' => $user,'data'=>$reports]);
        }
    }
}
