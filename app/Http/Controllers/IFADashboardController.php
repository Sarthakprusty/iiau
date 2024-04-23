<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IFADashboardController extends Controller
{
    //
    function get(Request $request){
        $user = Auth::user();
        $request->session()->put('month', date('m'));
        $request->session()->put('year', date('Y'));
        return view('ifa-dashboard', ['user'=>$user]);
    }

    function find(Request $request){
        $user = Auth::user();
        $monthYear = $request->get('report_month');
        Log::debug('Report month is:{report_month}',['report_month'=>$monthYear]);
        $inputArr = explode('-',$monthYear);
        $month = $inputArr[1];
        $year = $inputArr[0];
        $data = [];
        $request->session()->put('month', $month);
        $request->session()->put('year', $year);
        $sections = Section::with(['reports'=>function($query) use ($month,$year){
            $query->where('month',$month)->where('year',$year);
        }])->orderBy('section_name')->get();

        return view('ifa-dashboard', ['user'=>$user,'data'=>$sections]);
    }
}
