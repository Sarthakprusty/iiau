<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    function save(Request $request) : RedirectResponse{
        $user = Auth::user();
        $month = session('month');
        $year = session('year');
        $report = new Report();
        $report->section_id = $user->section_id;
        $report->month = $month;
        $report->year = $year;
        $report->created_by = $user->id;
        $report->save();
        return redirect('/dashboard');
    }
}
