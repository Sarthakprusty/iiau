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
        if ($user->username == 'iiau'){
            return redirect()->intended('ifa-dashboard');
        }else {
            $request->session()->put('year', date('Y'));
            $reports = Report::where('year', session('year'))
                ->whereHas('statuses', function ($query) {
                    $query->whereIn('status_id', [2,3]) // Change to 'status_id' instead of 'pivot'
                    ->where('active', 1) // Change to 'active' instead of 'pivot'
                    ->where('section_id', Auth::user()->section_id); // Change to 'section_id' instead of 'pivot'
                })
                ->get();
            return view('USDashboard', ['user' => $user,'report'=>$reports]);
        }
    }

    function find(Request $request){
        $user = Auth::user();
        if ($user->username == 'iiau'){
            return redirect()->intended('ifa-dashboard');
        }else {
            $Year = $request->get('report_year');
            Log::debug('Report year is:{report_year}', ['report_year' => $Year]);
            $request->session()->put('year', $Year);
            $reports = Report::where('year', $Year)
                ->whereHas('statuses', function ($query) {
                    $query->whereIn('status_id', [2,3]) // Change to 'status_id' instead of 'pivot'
                    ->where('active', 1) // Change to 'active' instead of 'pivot'
                    ->where('section_id', Auth::user()->section_id); // Change to 'section_id' instead of 'pivot'
                })
                ->get();
            return view('USDashboard', ['user' => $user,'data'=>$reports]);
        }
    }
}
