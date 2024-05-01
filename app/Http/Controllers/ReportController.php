<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Pending15;
use App\Models\Promotion;
use App\Models\Reference;
use App\Models\Report;
use App\Models\Section;
use App\Models\Uniform;
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

           ];

           return view('reports.section',['data'=>$data,'section'=>$section, 'month'=>$monthName, 'report'=>$reports]);
       }
       else{
           $whereClause = [
               ['month',$month],
               ['year',$year]
           ];
           $works =        DB::select('select section_name, ANY_VALUE(`desc`)  `desc`, sum(brought_forward) brought_forward, sum(received) received, sum(disposed) disposed,sum(balance) balance, sum(pending_1) pending_1, sum(pending_3) pending_3 from sections s join works w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);
           $promotions =   DB::select('select section_name, ANY_VALUE(`desc`)  `desc`,ANY_VALUE(`remarks`) `remarks`, sum(due) due, sum(settled) settled, sum(variation) variation from sections s join promotions  w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);
           $bills =        DB::select('select section_name, ANY_VALUE(`remarks`) `remarks`,sum(rec) rec, sum(settled) settled, sum(prev_due) prev_due, sum(bal) bal from sections s join bills w on s.id=w.section_id and w.deleted_at is null and s.deleted_at is null join reports r on s.id=r.section_id and r.month=w.month and r.year=w.year and r.deleted_at is null where  w.month = ? and w.year = ? group by s.section_name', [$month,$year]);
           $references = DB::select('SELECT 
                                                            s.section_name, 
                                                            w.`desc`,
                                                            w.`remarks`,
                                                            w.`date_of_comm`,
                                                            w.`date_of_reply`,
                                                            w.`date_of_action` 
                                                        FROM 
                                                            sections s 
                                                        JOIN 
                                                            `references` w ON s.id = w.section_id 
                                                        JOIN 
                                                            reports r ON s.id = r.section_id AND r.month = w.month AND r.year = w.year 
                                                        WHERE  
                                                            w.month = ? 
                                                            AND w.year = ? 
                                                            AND w.deleted_at IS NULL 
                                                            AND s.deleted_at IS NULL 
                                                            AND r.deleted_at IS NULL 
                                                        GROUP BY 
                                                            s.section_name, 
                                                            w.`desc`, 
                                                            w.`remarks`, 
                                                            w.`date_of_comm`, 
                                                            w.`date_of_reply`, 
                                                            w.`date_of_action`', [$month, $year]);

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
               ->where('w.month', '=', $month)
               ->where('w.year', '=', $year)
               ->whereNull('sections.deleted_at')
               ->groupBy('w.description', 'w.status', 'w.cut_off_date', 'sections.section_name')
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

           ];
           return view('reports.consolidated',['data'=>$data, 'month'=>$monthName]);
       }

   }
}
