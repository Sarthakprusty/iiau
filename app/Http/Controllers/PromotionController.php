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
            $work->due = isset($r['due']) ? $r['due'] : 0;
            $work->settled = isset($r['settled']) ? $r['settled'] : 0;
            $work->variation = $work->due-$work->settled;
            $work->remarks = $r['remarks'];
            $work->created_by = $user->id;
            $work->save();
        }

        return redirect('/promotions');

    }
    function delete($id){
        $record = Promotion::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Record deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }

}
