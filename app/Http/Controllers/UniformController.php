<?php

namespace App\Http\Controllers;

use App\Models\Uniform;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UniformController extends Controller
{
    function form(Request $request): View{
        $user = Auth::user();
        $bills = Uniform::where('created_by',$user->id)
            ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
            ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
            ->orderBy('created_at')
            ->get();
        return view('uniforms', ['user'=>$user,'uniforms'=>$bills]);
    }

    function save(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $uniform = new Uniform();
            $uniform->section_id = $user->section_id;
            $uniform->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $uniform->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $uniform->description = $r['description'];
            $uniform->status = $r['status'];
            $uniform->cut_off_date = $r['cut_off_date'];
            $uniform->created_by = $user->id;
            $uniform->save();
        }

        return redirect('/uniforms');

    }

    function delete($id){
        $record = Uniform::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Uniform data deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }

}
