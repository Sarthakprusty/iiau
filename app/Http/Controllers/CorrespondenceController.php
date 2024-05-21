<?php

namespace App\Http\Controllers;


use App\Models\Correspondence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CorrespondenceController extends Controller
{
    function form(Request $request): View{
        $user = Auth::user();
        $correspondences = Correspondence::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('correspondences', ['user'=>$user,'correspondences'=>$correspondences]);
    }

    function saveCorrespondence(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $correspondence = new Correspondence();
            $correspondence->section_id = $user->section_id;
            $correspondence->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $correspondence->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $correspondence->rec = isset($r['rec']) ? $r['rec'] : 0;
            $correspondence->settled = isset($r['settled']) ? $r['settled'] : 0;
            $correspondence->prev_due = isset($r['prev_due']) ? $r['prev_due'] : 0;
            $max_settled = $correspondence->rec + $correspondence->prev_due;
            $correspondence->remarks = $r['remarks'];
            $correspondence->desc = $r['desc'];
            $correspondence->bal = $r['rec']+$r['prev_due']-$r['settled'];
            if ($correspondence->settled > $max_settled) {
                return back()->withInput($request->input())->with('error','Settled amount cannot be greater than the sum of rec and prev_due..');
            }
            $correspondence->created_by = $user->id;
            $correspondence->save();
        }

        return redirect('/correspondences');

    }

    function delete($id){
        $record = Correspondence::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Record deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }

}
