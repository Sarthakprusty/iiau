<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Bill;
use App\Models\Other;
use App\Models\Pending15;
use App\Models\Promotion;
use App\Models\Reference;
use App\Models\Report;
use App\Models\Section;
use App\Models\Status;
use App\Models\Uniform;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $status = $report->statuses()->wherePivot('active', 1)->get();
        $report->statuses()->updateExistingPivot(
            $status,
            [
                'active' => 0,
                'updated_at' => carbon::now()->toDateTimeLocalString()
            ]
        );
        $statusId = 2;
        $status = Status::find($statusId);
        if ($status) {
            $report->statuses()->attach($status, [
                'created_from' => $request->ip(),
                'created_by' => Auth::user()->id,
                'section_id' => Auth::user()->section_id,
                'created_at' => carbon::now()->toDateTimeLocalString()
            ]);
        }
        return redirect('/dashboard');
    }

    function edit(Request $request,$id) : RedirectResponse{
        $user = Auth::user();
        $month = session('month');
        $year = session('year');
        $report = Report::findOrFail($id);
        $report->section_id = $user->section_id;
        $report->month = $month;
        $report->year = $year;
        $report->created_by = $user->id;
        $report->save();
        $status = $report->statuses()->wherePivot('active', 1)->get();
        $report->statuses()->updateExistingPivot(
            $status,
            [
                'active' => 0,
                'updated_at' => carbon::now()->toDateTimeLocalString()
            ]
        );
        $statusId = 2;
        $status = Status::find($statusId);
        if ($status) {
            $report->statuses()->attach($status, [
                'created_from' => $request->ip(),
                'created_by' => Auth::user()->id,
                'section_id' => Auth::user()->section_id,
                'created_at' => carbon::now()->toDateTimeLocalString()
            ]);
        }
        return redirect('/dashboard');
    }

   function getReport($year, $month, $section_id=null){
       $myDate = "01/$month/$year";
       $date = Carbon::createFromFormat('d/m/Y', $myDate);
       $monthName = $date->format('F, Y');
       $user = Auth::user();
       if ($section_id == null)
           $section_id = $user->section_id;
       if ($section_id != 'consolidated'){
           $section = Section::find($section_id);
           $whereClause = [
               ['section_id',$section_id],
               ['month',$month],
               ['year',$year]
           ];
           $bills = Bill::where($whereClause)->get();
           $works = Work::where($whereClause)->get();
           $promotions = Promotion::where($whereClause)->get();
           $references = Reference::where($whereClause)->get();
           $reports = Report::where($whereClause)->get();
           $uniform = Uniform::where($whereClause)->get();
           $pending15 = Pending15::where($whereClause)->get();
           $other = Other::where($whereClause)->get();

//           $lastUpdatedBill = '';
//           if ( $bills && !empty($bills) && $bills!==null ) {
//               return $bills;
//               $lastUpdatedBill = date_format(date_create($bills[0]->last_updated), 'd/m/Y H:i');
//           }

           $data = [
               'bills'=>[
                   'desc'=>'Bills',
                   'data'=>$bills,
//                   'last_updated'=>date_format(date_create($bills[0]->last_updated), 'd/m/Y H:i')
               ],
               'works'=>[
                   'desc'=>'Work Report',
                   'data'=>$works,
//                   'last_updated'=>date_format(date_create($works[0]->last_updated),'d/m/Y H:i')
               ],
               'promotions'=>[
                   'desc'=>'Promotions, Retirement etc',
                   'data'=>$promotions,
//                   'last_updated'=>date_format(date_create($promotions[0]->last_updated),'d/m/Y H:i')
               ],
               'references'=>[
                   'desc'=>'References',
                   'data'=>$references,
//                   'last_updated'=>date_format(date_create($references[0]->last_updated),'d/m/Y H:i')
               ],
               'pending15'=>[
                   'desc'=>'Pending Beyond 15 days',
                   'data'=>$pending15,
//                   'last_updated'=>date_format(date_create($pending15[0]->last_updated),'d/m/Y H:i')
               ],
               'uniforms'=>[
                   'desc'=>'Uniform Status',
                   'data'=>$uniform,
//                   'last_updated'=>date_format(date_create($uniform[0]->last_updated),'d/m/Y H:i')
               ],
               'others'=>[
                   'desc'=>'Other Status',
                   'data'=>$other,
//                   'last_updated'=>date_format(date_create($other[0]->last_updated),'d/m/Y H:i')
               ],

           ];
           $statuses=[];
           if($user->role==2 || $user->role==1) {
               $report = Report::where('section_id', $user->section_id)->where('year', $year)->where('month', $month)->first();
               if ($report) {
                   $statuses = $report->statuses()
//                       ->where('report_status.active', 1)
                       ->whereNotNull('remark')
                       ->get();
                   foreach ($statuses as $status)
                       $status->user = User::findorfail($status->pivot->created_by);
               }
               return view('reports.usReport',['data'=>$data,'section'=>$section, 'month'=>$monthName, 'report'=>$reports,'user'=>$user,'statuses'=>$statuses,'reports'=>$report]);
           }
           else
           return view('reports.section',['data'=>$data,'section'=>$section, 'month'=>$monthName, 'report'=>$reports,'user'=>$user,]);
       }
       else{
           $whereClause = [
               ['month',$month],
               ['year',$year]
           ];
//           $works =        DB::select('select section_name, sum(brought_forward) brought_forward, sum(received) received, sum(disposed) disposed,sum(balance) balance, sum(pending_15) pending_15, sum(pending_30) pending_30,sum(pending_60) pending_60, from sections s join works w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);
//           $promotions =   DB::select('select section_name, sum(due) due, sum(settled) settled, sum(variation) variation from sections s join promotions  w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);
//           $bills =        DB::select('select section_name, sum(rec) rec, sum(settled) settled, sum(prev_due) prev_due, sum(bal) bal from sections s join bills w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);

           $works = DB::table('sections as s')
               ->join('works as w', function ($join) {
                   $join->on('s.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('s.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->select(
                   's.section_name',
                   DB::raw('SUM(w.brought_forward) as brought_forward'),
                   DB::raw('SUM(w.received) as received'),
                   DB::raw('SUM(w.disposed) as disposed'),
                   DB::raw('SUM(w.balance) as balance'),
                   DB::raw('SUM(w.pending_15) as pending_15'),
                   DB::raw('SUM(w.pending_30) as pending_30'),
                   DB::raw('SUM(w.pending_60) as pending_60')
               )
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('s.deleted_at')
               ->groupBy('s.section_name')
               ->get();

           $promotions = DB::table('sections as s')
               ->join('promotions as w', function ($join) {
                   $join->on('s.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('s.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->select(
                   's.section_name',
                   DB::raw('SUM(w.due) as due'),
                   DB::raw('SUM(w.settled) as settled'),
                   DB::raw('SUM(w.variation) as variation')
               )
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('s.deleted_at')
               ->groupBy('s.section_name')
               ->get();

           $bills = DB::table('sections as s')
               ->join('bills as w', function ($join) {
                   $join->on('s.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('s.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->select(
                   's.section_name',
                   DB::raw('SUM(w.rec) as rec'),
                   DB::raw('SUM(w.settled) as settled'),
                   DB::raw('SUM(w.prev_due) as prev_due'),
                   DB::raw('SUM(w.bal) as bal')
               )
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('s.deleted_at')
               ->groupBy('s.section_name')
               ->get();



           $references = DB::table('sections')
               ->select('w.desc', 'w.remarks', 'w.date_of_comm','w.date_of_reply', 'w.date_of_action', 'sections.section_name')
               ->join('references as w', function ($join) {
                   $join->on('sections.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('sections.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('sections.deleted_at')
               ->groupBy('w.desc', 'w.remarks', 'w.date_of_comm','w.date_of_reply', 'w.date_of_action', 'sections.section_name')
               ->get();

             $pending15 = DB::table('sections')
               ->select('w.desc', 'w.reason', 'w.action', 'sections.section_name')
               ->join('pending_15 as w', function ($join) {
                   $join->on('sections.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('sections.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
                 ->join('report_status as rs', function ($join) {
                     $join->on('r.id', '=', 'rs.report_id')
                         ->where('rs.active', 1)
                         ->where('rs.status_id', 3);
                 })
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('sections.deleted_at')
               ->groupBy('w.desc', 'w.reason', 'w.action', 'sections.section_name')
               ->get();

           $uniform = DB::table('sections')
               ->select('w.description', 'w.status', 'w.cut_off_date', 'sections.section_name')
               ->join('uniforms  as w', function ($join) {
                   $join->on('sections.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('sections.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('sections.deleted_at')
               ->groupBy('w.description', 'w.status', 'w.cut_off_date', 'sections.section_name')
               ->get();

           $other = DB::table('sections')
               ->select('w.desc', 'w.title', 'sections.section_name')
               ->join('others  as w', function ($join) {
                   $join->on('sections.id', '=', 'w.section_id')
                       ->whereNull('w.deleted_at');
               })
               ->join('reports as r', function ($join) use ($month, $year) {
                   $join->on('sections.id', '=', 'r.section_id')
                       ->where('r.month', '=', $month)
                       ->where('r.year', '=', $year)
                       ->whereNull('r.deleted_at');
               })
               ->join('report_status as rs', function ($join) {
                   $join->on('r.id', '=', 'rs.report_id')
                       ->where('rs.active', 1)
                       ->where('rs.status_id', 3);
               })
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('sections.deleted_at')
               ->groupBy('w.desc', 'w.title', 'sections.section_name')
               ->get();


           $data = [
               'works'=>[
                   'desc'=>'Work Report',
                   'data'=>$works,
               ],
               'bills'=>[
                   'desc'=>'Bills',
                   'data'=>$bills,
//                   'last_updated'=>date_format(date_create($bills[0]->last_updated),'d/m/Y H:i')
               ],
               'promotions'=>[
                   'desc'=>'Promotions, Retirement etc',
                   'data'=>$promotions,
//                   'last_updated'=>date_format(date_create($promotions[0]->last_updated),'d/m/Y H:i')
               ],
               'references'=>[
                   'desc'=>'References',
                   'data'=>$references,
//                   'last_updated'=>date_format(date_create($references[0]->last_updated),'d/m/Y H:i')
               ],
               'pending15'=>[
                   'desc'=>'Pending Beyond 15 days',
                   'data'=>$pending15,
//                   'last_updated'=>date_format(date_create($pending15[0]->last_updated),'d/m/Y H:i')
               ],
               'uniforms'=>[
                   'desc'=>'Uniform Status',
                   'data'=>$uniform,
//                   'last_updated'=>date_format(date_create($uniform[0]->last_updated),'d/m/Y H:i')
               ],
               'others'=>[
                   'desc'=>'Other Status',
                   'data'=>$other,
//                   'last_updated'=>date_format(date_create($other[0]->last_updated),'d/m/Y H:i')
               ],

           ];
           return view('reports.consolidated',['data'=>$data, 'month'=>$monthName]);
       }

   }

    function updateStatus(Request $request,$id){
        $action = $request->input('submit');
        $report = Report::findOrFail($id);
        $remarks = $request->input('remarks');
        $user = auth()->user();

        if ($action == 'Approve')  {
            $status = $report->statuses()->wherePivot('active', 1)->get();
            $report->statuses()->updateExistingPivot(
                $status,
                [
                    'active' => 0,
                    'updated_at'=> carbon::now()->toDateTimeLocalString()
                ]
            );
            $status_id = 3;
            $status = Status::findOrFail($status_id);
            $report->statuses()->attach(
                $status,
                [
                    'section_id' => $user->section_id,
                    'remark' => $remarks,
                    'created_from' => $request->ip(),
                    'created_by' => Auth::user()->id,
                    'created_at'=>carbon::now()->toDateTimeLocalString()
                ]
            );

            return redirect()->intended('USDashboard');
        }
        elseif ($action == 'Return')   {
            $status = $report->statuses()->wherePivot('active', 1)->get();
            $report->statuses()->updateExistingPivot(
                $status,
                [
                    'active' => 0,
                    'updated_at'=> carbon::now()->toDateTimeLocalString()
                ]
            );
            $status_id = 1;
            $status = Status::findOrFail($status_id);
            $report->statuses()->attach(
                $status,
                [
                    'section_id' => $user->section_id,
                    'remark' => $remarks,
                    'created_from' => $request->ip(),
                    'created_by' => Auth::user()->id,
                    'created_at'=>carbon::now()->toDateTimeLocalString()
                ]
            );

            return redirect()->intended('USDashboard');
        }


    }


}
