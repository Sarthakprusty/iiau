<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WorkController extends Controller
{
    //
    function form(Request $request): View{
        $user = Auth::user();
        $works = Work::where('created_by',$user->id)
                    ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
                    ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
                    ->orderBy('created_at')
                    ->get();
        return view('works', ['user'=>$user,'works'=>$works]);
    }

    function saveWork(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $work = new Work();
            $work->section_id = $user->section_id;
            $work->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $work->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $work->desc = $r['desc'];
            $work->brought_forward = $r['bf']?$r['bf']:0;
            $work->received = $r['recd']?$r['recd']:0;
            $work->disposed = $r['disp']?$r['disp']:0;
            $work->pending_15 = $r['p15d']?$r['p15d']:0;
            $work->pending_30 = $r['p30d']?$r['p30d']:0;
            $work->pending_60 = $r['p60d']?$r['p60d']:0;
            $work->balance = $work->brought_forward+$work->received-$work->disposed;
            $totalPending = $work->pending_60 + $work->pending_30 + $work->pending_15;
            if ($totalPending > $work->balance) {
                return back()->with('error','Total Pending should not be more than closing balance..');
            }

            $work->created_by = $user->id;
            $work->save();
        }

        return redirect('/works');

    }

    function delete($id){
        $record = Work::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Bill deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }

}
