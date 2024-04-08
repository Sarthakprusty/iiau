<?php

namespace App\Http\Controllers;

use App\Models\Pending15;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Pending15Controller extends Controller
{
    //
    function index(Request $request):View
    {
        $user = Auth::user();
        $pending15 = Pending15::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('pending15', ['user'=>$user,'pending15'=>$pending15]);
    }

    function add(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $p15 = new Pending15();
            $p15->section_id = $user->section_id;
            $p15->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $p15->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $p15->desc = $r['desc'];
            $p15->reason = $r['reason'];
            $p15->action = $r['action'];
            $p15->created_by = $user->id;
            $p15->save();
        }

        return redirect('/pending15');
    }

    function delete($id)
    {
        $record = Pending15::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Record deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }
}
