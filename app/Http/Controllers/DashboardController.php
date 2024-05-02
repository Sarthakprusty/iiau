<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //
    function get(Request $request){
        $user = Auth::user();
        if ($user->username == 'iiau'){
            return redirect()->intended('ifa-dashboard');
        }else {
            $request->session()->put('month', date('m'));
            $request->session()->put('year', date('Y'));
            return view('dashboard', ['user' => $user]);
        }
    }

    function find(Request $request){
        $user = Auth::user();
        if ($user->username == 'iiau'){
            return redirect()->intended('ifa-dashboard');
        }else {
            $monthYear = $request->get('report_month');
            Log::debug('Report month is:{report_month}', ['report_month' => $monthYear]);
            $inputArr = explode('-', $monthYear);
            $month = $inputArr[1];
            $year = $inputArr[0];
            $data = [];
            $request->session()->put('month', $month);
            $request->session()->put('year', $year);
            $whereClause = [
                ['section_id', $user->section_id],
                ['month', $request->session()->get('month') ? $request->session()->get('month') : date('m')],
                ['year', $request->session()->get('year') ? $request->session()->get('year') : date('Y')],
                ['deleted_at', null]
            ];
            $selectString = "count(*) as cnt, max(created_at) as last_updated";
            $bills = DB::table('bills')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $works = DB::table('works')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $promotions = DB::table('promotions')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $references = DB::table('references')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $reports = DB::table('reports')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $pending15 = DB::table('pending_15')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $uniform = DB::table('uniforms')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $other = DB::table('others')
                ->select(DB::raw($selectString))
                ->where($whereClause)
                ->get();
            $request->session()->put('report_submitted', false);
            $request->session()->put('report_submitted_at', '');
            if ($reports[0]->cnt > 0) {
                $request->session()->put('report_submitted', true);
                $request->session()->put('report_submitted_at', date_format(date_create($reports[0]->last_updated), 'd/m/Y H:i'));
            }

            $data = [
                'bills' => [
                    'desc' => 'Bills',
                    'cnt' => $bills[0]->cnt,
                    'last_updated' => date_format(date_create($bills[0]->last_updated), 'd/m/Y H:i')
                ],
                'works' => [
                    'desc' => 'Work Report',
                    'cnt' => $works[0]->cnt,
                    'last_updated' => date_format(date_create($works[0]->last_updated), 'd/m/Y H:i')
                ],
                'promotions' => [
                    'desc' => 'Promotions, Retirement etc',
                    'cnt' => $promotions[0]->cnt,
                    'last_updated' => date_format(date_create($promotions[0]->last_updated), 'd/m/Y H:i')
                ],
                'references' => [
                    'desc' => 'References',
                    'cnt' => $references[0]->cnt,
                    'last_updated' => date_format(date_create($references[0]->last_updated), 'd/m/Y H:i')
                ],
                'pending15' => [
                    'desc' => 'Pending Beyond 15 days',
                    'cnt' => $pending15[0]->cnt,
                    'last_updated' => date_format(date_create($pending15[0]->last_updated), 'd/m/Y H:i')
                ],
                'uniforms' => [
                    'desc' => 'Uniform Status',
                    'cnt' => $uniform[0]->cnt,
                    'last_updated' => date_format(date_create($uniform[0]->last_updated), 'd/m/Y H:i')
                ],
                'others' => [
                    'desc' => 'Other Status',
                    'cnt' => $other[0]->cnt,
                    'last_updated' => date_format(date_create($other[0]->last_updated), 'd/m/Y H:i')
                ],

            ];
            return view('dashboard', ['user' => $user, 'data' => $data,]);
        }
    }
}
