@extends('layout.main')


@section('title', 'SectionReport')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (($user->role === 2 && $report[0]->statuses->first() && $report[0]->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(2)))
                <div class="col-md-9">
            @endif

            @if(( $user->role === 1 && (!$report || empty($report) || $report->isEmpty())) || ($user->role === 1 && $report[0]->statuses->first() && $report[0]->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)) )
                <div class="container">
            @endif

                <div class="row" style="margin-top: 10px">
                    @if (isset($statuses) && !empty($statuses) && $statuses->isNotEmpty() )
                        <div class="card text-white bg-info mb-3">
                        <div class="row" >
                            <div class="card-header">Note:</div>
                            <div class="card-body">
                                @foreach ($statuses as $status)
                                    <p class="card-text">
                                        {{ $status->user ? $status->user->name : 'N/A' }} - {{ $status->pivot->remark }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <b>
                        <h4 style="width: 100%; text-align: center;text-decoration: underline">
                            PRESIDENT'S SECRETARIAT<br/>
                            {{$section->section_name}}
                        </h4>
                    </b>
                    <div style="width: 100%; text-align: right">
                        @if($report && !empty($report) && $report->isNotEmpty() )
                            Dated:{{date_format($report[0]->created_at,'d/m/Y')}}
                        @endif
                    </div>
                </div>

                <br>

                <div class="report">
                    <h4>Work Report for {{$month}}</h4>
                    <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Task</th>
                            <th>Task type</th>
                            <th>BF</th>
                            <th>Recd.</th>
                            <th>Disposed</th>
                            <th>Balance</th>
                            <th>Pending<br/>>15 days</th>
                            <th>Pending<br/>>30 days</th>
                            <th>Pending<br/>>60 days</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $t_brought_forward = 0;
                            $t_received = 0;
                            $t_disposed = 0;
                            $t_balance = 0;
                            $t_pending_15 = 0;
                            $t_pending_30 = 0;
                            $t_pending_60 = 0;
                        @endphp
                        @foreach ($data['works']['data'] as $work)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$work->desc}}</td>
                                <td class="text" >{{$work->action}}</td>
                                <td class="text" >{{$work->bill_receipt_desc}}</td>
                                <td class="number">{{$work->brought_forward}}</td>
                                <td class="number">{{$work->received}}</td>
                                <td class="number">{{$work->disposed}}</td>
                                <td class="number">{{$work->balance}}</td>
                                <td class="number">{{$work->pending_15}}</td>
                                <td class="number">{{$work->pending_30}}</td>
                                <td class="number">{{$work->pending_60}}</td>
                            </tr>
                            @php
                                $t_brought_forward += $work->brought_forward;
                                $t_received += $work->received;
                                $t_disposed += $work->disposed;
                                $t_balance += $work->balance;
                                $t_pending_15 += $work->pending_15;
                                $t_pending_30 += $work->pending_30;
                                $t_pending_60 += $work->pending_60;
                            @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>{{$t_brought_forward}}</th>
                            <th>{{$t_received}}</th>
                            <th>{{$t_disposed}}</th>
                            <th>{{$t_balance}}</th>
                            <th>{{$t_pending_15}}</th>
                            <th>{{$t_pending_30}}</th>
                            <th>{{$t_pending_60}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                {{--                                <div class="report">--}}
                {{--                                    <h4>Bills Processed in {{$month}}</h4>--}}
                {{--                                    <table  class="table table-bordered">--}}
                {{--                                        <thead>--}}
                {{--                                        <tr>--}}
                {{--                                            <th>Sl.</th>--}}
                {{--                                            <th>Description</th>--}}
                {{--                                            <th>Received</th>--}}
                {{--                                            <th>Settled</th>--}}
                {{--                                            <th>Previous Due</th>--}}
                {{--                                            <th>Balance</th>--}}
                {{--                                            <th>Remarks<br/>--}}
                {{--                                        </tr>--}}
                {{--                                        </thead>--}}
                {{--                                        <tbody>--}}
                {{--                                        @php--}}
                {{--                                            $bill_rec = 0;--}}
                {{--                                            $bill_settled = 0;--}}
                {{--                                            $bill_prev_due = 0;--}}
                {{--                                            $bill_bal = 0;--}}
                {{--                                        @endphp--}}
                {{--                                        @foreach ($data['bills']['data'] as $bills)--}}
                {{--                                            <tr>--}}
                {{--                                                <td class="text" >{{$bills->desc}}</td>--}}
                {{--                                                <td class="number">{{$loop->index + 1}}</td>--}}
                {{--                                                <td class="number">{{$bills->rec}}</td>--}}
                {{--                                                <td class="number">{{$bills->settled}}</td>--}}
                {{--                                                <td class="number">{{$bills->prev_due}}</td>--}}
                {{--                                                <td class="number">{{$bills->bal}}</td>--}}
                {{--                                                <td class="text" >{{$bills->remarks}}</td>--}}
                {{--                                            </tr>--}}
                {{--                                            @php--}}
                {{--                                                $bill_rec += $bills->rec;--}}
                {{--                                                $bill_settled += $bills->settled;--}}
                {{--                                                $bill_prev_due += $bills->prev_due;--}}
                {{--                                                $bill_bal += $bills->bal;--}}
                {{--                                            @endphp--}}
                {{--                                        @endforeach--}}
                {{--                                        </tbody>--}}
                {{--                                        <tfoot>--}}
                {{--                                        <tr>--}}
                {{--                                            <th colspan="2">Total</th>--}}
                {{--                                            <th>{{$bill_rec}}</th>--}}
                {{--                                            <th>{{$bill_settled}}</th>--}}
                {{--                                            <th>{{$bill_prev_due}}</th>--}}
                {{--                                            <th>{{$bill_bal}}</th>--}}
                {{--                                        </tr>--}}
                {{--                                        </tfoot>--}}
                {{--                                    </table>--}}
                {{--                                </div>--}}

                <br>

                <div class="report">
                    <h4>Promotions, Retirements etc in {{$month}}</h4>
                    <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Description</th>
                            <th>Due</th>
                            <th>Settled</th>
                            <th>Variation</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $t_due = 0;
                            $t_settled = 0;
                            $t_variation = 0;
                        @endphp
                        @foreach ($data['promotions']['data'] as $promotions)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$promotions->desc}}</td>
                                <td class="number">{{$promotions->due}}</td>
                                <td class="number">{{$promotions->settled}}</td>
                                <td class="number">{{$promotions->variation}}</td>
                                <td class="text" >{{$promotions->remarks}}</td>
                            </tr>
                            @php
                                $t_due += $promotions->due;
                                $t_settled += $promotions->settled;
                                $t_variation += $promotions->variation;
                            @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th colspan="1"></th>
                            <th>{{$t_due}}</th>
                            <th>{{$t_settled}}</th>
                            <th>{{$t_variation}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <br>

                <div class="report">
                    <h4>Communications in {{$month}}</h4>
                    <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Description</th>
                            <th>Date of Communication</th>
                            <th>Date of Reply</th>
                            <th>Date of Action</th>
                            <th>Remarks<br/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['references']['data'] as $references)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$references->desc}}</td>
                                <td class="number">{{ date_format(date_create($references->date_of_comm), 'd/m/Y') }}</td>
                                <td class="number">{{ date_format(date_create($references->date_of_reply), 'd/m/Y') }}</td>
                                <td class="number">{{ date_format(date_create($references->date_of_action), 'd/m/Y') }}</td>
                                <td class="text" >{{$references->remarks}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="report">
                    <h4>Status of Uniforms in {{$month}}</h4>
                    <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Cutoff date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['uniforms']['data'] as $uniform)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$uniform->description}}</td>
                                <td class="text" >{{$uniform->status}}</td>
                                <td class="number">{{ date_format(date_create($uniform->cut_off_date), 'd/m/Y')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="report">
                    <h4>Bills pending for more than 15 days in {{$month}}</h4>
                    <table  class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Description</th>
                            <th>Reason</th>
                            <th>Action Taken</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['pending15']['data'] as $pending15)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$pending15->desc}}</td>
                                <td class="text" >{{$pending15->reason}}</td>
                                <td class="text" >{{$pending15->action}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="report">
                    <h4>Other details {{$month}}</h4>
                    <table  class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['others']['data'] as $o)
                            <tr>
                                <td class="number">{{$loop->index + 1}}</td>
                                <td class="text" >{{$o->title}}</td>
                                <td class="text" >{{$o->desc}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br>

                <div style="text-align: right">
                    Prepared By<br/>
                    SO,{{$section->section_name}}
                </div>


            @if ($user->role === 2 && $report[0]->statuses->first() && $report[0]->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(2))
                </div>

                <div class="col-md-3">
                    <form method="post" action="{{ route('report.updateStatus', ['id' => $report[0]->id]) }}" id="submitstatusform">
                        @csrf
                        <div class="wrapper wrapper-content project-manager">
                            <div class="spacing" style="margin-top: 3%;"></div>
                            <strong><label style="font-size: 130%" for="remarks">Note:</label></strong>

                            <div class="spacing" style="margin-top: 2%;"></div>
                            <div class="row" style="margin-left: 0%; margin-right: 1.5%;">
                                <textarea class="form-control" id="remarks" name="remarks" style="height: 200px;" placeholder="abc....">{{ old('remarks') }}</textarea>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-6" style="text-align: right">
                                    <button type="submit" class="btn btn-success" name="submit" value="Approve" onclick="return confirm('Are you sure, You want to Approve this report?')">Approve</button>
                                </div>
                                <div class="col-6" style="text-align: left">
                                    <button type="submit" class="btn btn-danger" name="submit" value="Return" onclick="return confirm('Are you sure, You want to Return this report?')">Return</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            @elseif ( ( $user->role === 1 && (!$report || empty($report) || $report->isEmpty())) || ($user->role === 1 && $report[0]->statuses->first() && $report[0]->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1))  )
                </div>
                @php
                    $lastReport = \App\Models\Report::where('section_id', auth()->user()->section_id)
                        ->latest()
                        ->first();
                    if (!$lastReport || $lastReport == null) {
                        $todayMonth = date('n'); // Current month without leading zeros
                        $todayYear = date('Y'); // Get the current year
                    }
                @endphp
                <div class="row">
                    @if(($lastReport && $lastReport->month + 1 == session('month') && $lastReport->year == session('year')) || (!$lastReport && $todayMonth == session('month') && $todayYear == session('year')) )
                        <form action="{{ route('report.save') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger " style="margin-left: 48.5%">Forward</button>
                        </form>
                    @elseif($reports && $reports !== null &&  $reports->statuses->first() && $reports->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1) )
                        <form action="{{ route('report.edit', ['id' => $reports->id])  }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger " style="margin-left: 48.5%">Forward</button>
                        </form>
                    @elseif(session('report_submitted')==1)
                        Report submitted at {{session('report_submitted_at')}}
                    @else
                        Enter the previous report first.
                    @endif
                </div>
            @endif
        </div>

    </div>



    {{--        <div style="width: 5%;display: flex;float: right"></div>--}}
    {{--        <div style="width: 15%;display: flex;float: right">--}}
    {{--            <form method="post" action="{{ route('report.updateStatus', ['id' => $report[0]->id]) }}" id="submitstatusform">--}}
    {{--                @csrf--}}
    {{--                <div style="margin-top: 3%;">--}}
    {{--                    <strong style="font-size: 130%;">Note:</strong>--}}
    {{--                    <div style="margin-top: 2%;">--}}
    {{--                        <textarea class="form-control" id="remarks" name="remarks" style="height: 200px; width: 100%;" placeholder="abc....">{{ old('remarks') }}</textarea>--}}
    {{--                    </div>--}}
    {{--                    <div>--}}
    {{--                        <button type="submit" style="margin-right: 10px; margin-top: 10px;" class="btn btn-success" name="submit" value="Approve" onclick="return confirm('Are you sure, You want to Approve this report?')">Approve</button>--}}
    {{--                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger" name="submit" value="Return" onclick="return confirm('Are you sure, You want to Return this report?')">Return</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </form>--}}
    {{--        </div>--}}



@endsection
