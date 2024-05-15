<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //
    function get(Request $request){
        $user = Auth::user();
        if($user->role==2)
            return redirect()->intended('USDashboard');
        if($user->role==3)
            return redirect()->intended('ifa-dashboard');
        else {
            $request->session()->put('month', date('m'));
            $request->session()->put('year', date('Y'));
            return $this->extracted($user, $request);
        }
    }

    function find(Request $request){
        $user = Auth::user();
        if($user->role==2)
            return redirect()->intended('USDashboard');
        if($user->role==3)
            return redirect()->intended('ifa-dashboard');
        else {
            $monthYear = $request->get('report_month');
            Log::debug('Report month is:{report_month}', ['report_month' => $monthYear]);
            $inputArr = explode('-', $monthYear);
            $month = $inputArr[1];
            $year = $inputArr[0];
            $data = [];
            $request->session()->put('month', $month);
            $request->session()->put('year', $year);
            return $this->extracted($user, $request);
        }
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function extracted(?\Illuminate\Contracts\Auth\Authenticatable $user, Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View
    {
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
//        $correspondence = DB::table('correspondences')
//            ->select(DB::raw($selectString))
//            ->where($whereClause)
//            ->get();
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
//            'correspondences' => [
//                'desc' => 'correspondence Status',
//                'cnt' => $correspondence[0]->cnt,
//                'last_updated' => date_format(date_create($correspondence[0]->last_updated), 'd/m/Y H:i')
//            ],

        ];
        $statuses = [];
        $report = Report::where('section_id', $user->section_id)->where('year', session('year'))->where('month', session('month'))->first();
        if ($report) {
            $statuses = $report->statuses()
//                    ->where('report_status.active', 1)
                ->whereNotNull('remark')
                ->get();
            foreach ($statuses as $status)
                $status->user = User::findorfail($status->pivot->created_by);
        }
        return view('dashboard', ['user' => $user, 'data' => $data, 'statuses' => $statuses]);
    }
}
