<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Work;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PromotionController extends Controller
{
    //
    function form(Request $request): View{
        $user = Auth::user();
        $promotions = Promotion::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('promotions', ['user'=>$user,'promotions'=>$promotions]);
    }

    function savePromotion(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $work = new Promotion();
            $work->section_id = $user->section_id;
            $work->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $work->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $work->desc = $r['desc'];
            $work->due = $r['due'];
            $work->settled = $r['settled'];
            $work->variation = $r['variation'];
            $work->remarks = $r['remarks'];
            $work->created_by = $user->id;
            $work->save();
        }

        return redirect('/promotions');

    }
}
