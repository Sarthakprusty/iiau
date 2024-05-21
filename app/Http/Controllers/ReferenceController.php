<?php

namespace App\Http\Controllers;


use App\Models\Reference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReferenceController extends Controller
{
    //
    //
    function form(Request $request): View{
        $user = Auth::user();
        $references = Reference::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('references', ['user'=>$user,'references'=>$references]);
    }

    function saveReference(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $work = new Reference();
            $work->section_id = $user->section_id;
            $work->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $work->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $work->desc = $r['desc'];
            $work->date_of_comm = $r['date_of_comm'];
            $work->date_of_reply = $r['date_of_reply'];
            $work->date_of_action = $r['date_of_action'];
            $work->remarks = $r['remarks'];
            $work->created_by = $user->id;
            $work->save();
        }

        return redirect('/references');

    }
    function delete($id){
        $record = Reference::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Record deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }

}
