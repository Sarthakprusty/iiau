<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BillController extends Controller
{
    //
    function form(Request $request): View{
        $user = Auth::user();
        $bills = Bill::where('created_by',$user->id)
                    ->where('month',$request->session()->get('month')?$request->session()->get('month'):date('m'))
                    ->where('year',$request->session()->get('year')?$request->session()->get('year'):date('Y'))
                    ->orderBy('created_at')
                    ->get();
        return view('bills', ['user'=>$user,'bills'=>$bills]);
    }

    function saveBill(Request $request): RedirectResponse{
        $user = Auth::user();
        $rec = $request->input('record');
        foreach ($rec as $r){
            $bill = new Bill();
            $bill->section_id = $user->section_id;
            $bill->month = $request->session()->get('month')?$request->session()->get('month'):date('m');
            $bill->year = $request->session()->get('year')?$request->session()->get('year'):date('Y');
            $bill->rec = isset($r['rec']) ? $r['rec'] : 0;
            $bill->settled = isset($r['settled']) ? $r['settled'] : 0;
            $bill->prev_due = isset($r['prev_due']) ? $r['prev_due'] : 0;
            $bill->bal = $r['rec']+$r['prev_due']-$r['settled'];
            $bill->remarks = $r['remarks'];
            $bill->created_by = $user->id;
            $bill->save();
        }

        return redirect('/bills');

    }

    function delete($id){
        $record = Bill::find($id);
        $user = Auth::user();
        if($record->created_by == $user->id){
            $record->delete();
            return back()->with('success','Bill deleted successfully.');
        }
        return back()->with('error','Unauthorised Access.');
    }



}
