<?php

namespace App\Http\Controllers;

use App\Models\Other;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OthersController extends Controller
{
    function index(Request $request):View
    {
        $user = Auth::user();
        $Other = Other::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('others', ['user'=>$user,'Other'=>$Other]);
    }

    function add(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $p15 = new Other();
            $p15->section_id = $user->section_id;
            $p15->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $p15->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $p15->desc = $r['desc'];
            $p15->title = $r['title'];
            $p15->created_by = $user->id;
            $p15->save();
        }

        return redirect('/Other');
    }

    function delete($id)
    {
        $record = Other::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Record deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }
}
