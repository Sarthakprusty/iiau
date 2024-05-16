@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
    <div class="container">
        <h2>
            Dashboard
        </h2>
        <form action="{{route('dashboard.find')}}" method="POST">

            <div class="row">

                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            Report for Month
                        </div>
                        <div class="card-body">
                            @csrf
                            <input type="month" id="report_month" name="report_month" class="form-control" value="{{session('year')}}-{{session('month')}}" />

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-md-end">FETCH</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        @if (isset($statuses) && !empty($statuses) && $statuses->isNotEmpty())
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Note:</div>
                <div class="card-body">
                    @foreach ($statuses as $status)
                        <p class="card-text">
                            {{ $status->user ? $status->user->username : 'N/A' }} - {{ $status->pivot->remark }}
                        </p>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($data))
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Status of {{ session('month') }}/{{ session('year') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($data as $key => $value)
                                    <div class="col-md-4">
                                        @if(isset($data[$key]) && $data[$key]['cnt'] > 0)
                                            <div class="card border-primary mb-3">
                                                @else
                                                    <div class="card border-default mb-3">
                                                        @endif
                                                        <div class="card-body">
                                                            <h3>{{$value['desc']}}</h3>
                                                            @if(isset($data[$key]) && $data[$key]['cnt'] > 0)
                                                                Last updated at: {{$data[$key]['last_updated']}}
                                                            @else
                                                                Not yet updated
                                                            @endif
                                                        </div>
                                                        <div class="card-footer">
                                                            @php
                                                                $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
                                                            @endphp
                                                            @if($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1))
                                                                <a href="{{ route($key) }}" class="btn btn-primary float-md-end">Update</a>
                                                            @elseif(session('report_submitted'))
                                                                <a href="{{ route($key) }}" class="btn btn-primary float-md-end">View</a>
                                                            @else
                                                                <a href="{{ route($key) }}" class="btn btn-primary float-md-end">Update</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                            </div>
                                            @endforeach
                                    </div>
                            </div>
                            <div class="card-footer">
{{--                                @php--}}
{{--                                    $lastReport = \App\Models\Report::where('section_id', auth()->user()->section_id)--}}
{{--                                        ->latest()--}}
{{--                                        ->first();--}}
{{--                                    if (!$lastReport || $lastReport == null) {--}}
{{--                                        $todayMonth = date('n'); // Current month without leading zeros--}}
{{--                                        $todayYear = date('Y'); // Get the current year--}}
{{--                                    }--}}
{{--                                @endphp--}}

{{--                                @if($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1))--}}
{{--                                    <form action="{{ route('report.edit', ['id' => $report->id])  }}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-danger float-md-end">Forward</button>--}}
{{--                                    </form>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                    <a href="{{ route('section_report', [session('year'), session('month'), Auth::user()->section_id]) }}" class="btn btn-success">View Report</a><br/>
                                    </div>
                                @if(session('report_submitted')==1)
                                        <div class="col-md-6" style="text-align: right">
                                    Report submitted at {{session('report_submitted_at')}}
                                        </div>
                                @endif
                                    </div>
{{--                                @elseif(($lastReport && $lastReport->month + 1 == session('month') && $lastReport->year == session('year')) || (!$lastReport && $todayMonth == session('month') && $todayYear == session('year')) )--}}
{{--                                    <form action="{{ route('report.save') }}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-danger float-md-end">Forward</button>--}}
{{--                                    </form>--}}

{{--                                --}}


{{--                                @elseif(session('report_submitted')==1)--}}
{{--                                    Report submitted at {{session('report_submitted_at')}}--}}

{{--                                @else--}}

{{--                                    Enter the previous report first.--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
@endsection
