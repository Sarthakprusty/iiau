@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
    <div class="container">
        <h2>
            Dashboard
        </h2>
        <form action="{{route('ifaDashboard.find')}}" method="POST">

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
        @if(isset($data))
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Submission Status
                        </div>
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $section)
                                <tr>
                                    <td>{{$loop->index + 1}}.</td>
                                    <td>{{$section->section_name}}</td>
                                    @if ($user->role === 3 && !empty($section->report) && $section->report[0]->statuses->first() && $section->report[0]->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(3))
                                    @if(sizeof($section->reports))
                                        <td>
                                            @php
                                                $sessionYear = session('year');
                                                $sessionMonth = session('month');
                                                $reportYear = $section->reports[0]->created_at->format('Y');
                                                $reportMonth = $section->reports[0]->created_at->format('m');
                                                $isSameYear = $sessionYear == $reportYear;
                                                $isSameMonth = $sessionMonth == $reportMonth;
                                                $givenDateTime = $section->reports[0]->created_at;
                                                $dateTenDaysAgo = clone $givenDateTime;
                                                $dateTenDaysAgo->modify('-10 days');
                                                $isWithinTenDays = $dateTenDaysAgo->format('Y') == $sessionYear && $dateTenDaysAgo->format('m') == $sessionMonth;
                                                $lastDateOfMonth = DateTime::createFromFormat('Y-m-d', "$sessionYear-$sessionMonth-" . date('t', strtotime("$sessionYear-$sessionMonth")));
                                                $difference = $lastDateOfMonth->diff($givenDateTime)->days;
                                            @endphp

                                            @if ($isSameYear && $isSameMonth)
                                                <a href="{{ route('section_report', [session('year'), session('month'), $section->id]) }}" class="btn btn-success">View Report</a><br/>
                                            @elseif ($isWithinTenDays)
                                                <a href="{{ route('section_report', [session('year'), session('month'), $section->id]) }}" class="btn btn-warning">View Report</a><br/>
                                            @elseif (($difference >= 10))
                                                <a href="{{ route('section_report', [session('year'), session('month'), $section->id]) }}" class="btn btn-danger">View Report</a><br/>
                                            @else
                                                <a href="{{ route('section_report', [session('year'), session('month'), $section->id]) }}" class="btn btn-secondary">View Report</a><br/>
                                            @endif
                                        </td>
                                        <td>
                                            {{date_format($section->reports[0]->created_at,'d/m/Y H:i:s')}}
                                        </td>
                                    @else
                                        <td style="text-decoration: line-through;color: red">
                                            Not Submitted
                                        </td>
                                    @endif
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            <a href="{{ route('section_report', [session('year'), session('month'), 'consolidated']) }}" class="btn btn-primary">View Complete Report</a>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>
@endsection
