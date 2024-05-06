@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
    <div class="container">
        <h2>
            Dashboard
        </h2>
        <form action="{{route('usDashboard.find')}}" method="POST">

            <div class="row">

                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            Report for Year
                        </div>
                        <div class="card-body">
                            @csrf
                            <input type="number" id="report_year" name="report_year" class="form-control" value="{{ session('year') }}" min="1900" max="9999" step="1">

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
                                <th>Month</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $report)
                                <tr>
                                    <td>{{$loop->index + 1}}.</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $report->month, 1)) }}</td>
                                    @if($report)
                                        <td>
                                            @php
                                                $sessionYear = $report->year;
                                                $sessionMonth = $report->month;
                                                $reportYear = $report->created_at->format('Y');
                                                $reportMonth = $report->created_at->format('m');
                                                $isSameYear = $sessionYear == $reportYear;
                                                $isSameMonth = $sessionMonth == $reportMonth;
                                                $givenDateTime = $report->created_at;
                                                $dateTenDaysAgo = clone $givenDateTime;
                                                $dateTenDaysAgo->modify('-10 days');
                                                $isWithinTenDays = $dateTenDaysAgo->format('Y') == $sessionYear && $dateTenDaysAgo->format('m') == $sessionMonth;
                                                $lastDateOfMonth = DateTime::createFromFormat('Y-m-d', "$sessionYear-$sessionMonth-" . date('t', strtotime("$sessionYear-$sessionMonth")));
                                                $difference = $lastDateOfMonth->diff($givenDateTime)->days;
                                            @endphp

                                            @if ($isSameYear && $isSameMonth)
                                                <a href="{{ route('section_report', [$sessionYear, $sessionMonth, Auth::user()->section_id]) }}" class="btn btn-success">View Report</a><br/>
                                            @elseif ($isWithinTenDays)
                                                <a href="{{ route('section_report', [$sessionYear, $sessionMonth, Auth::user()->section_id]) }}" class="btn btn-warning">View Report</a><br/>
                                            @elseif (($difference >= 10))
                                                <a href="{{ route('section_report', [$sessionYear, $sessionMonth, Auth::user()->section_id]) }}" class="btn btn-danger">View Report</a><br/>
                                            @else
                                                <a href="{{ route('section_report', [$sessionYear, $sessionMonth, Auth::user()->section_id]) }}" class="btn btn-secondary">View Report</a><br/>
                                            @endif
                                        </td>
                                        <td>
                                            {{date_format($report->created_at,'d/m/Y H:i:s')}}
                                        </td>
                                    @else
                                        <td style="text-decoration: line-through;color: red">
                                            Not Submitted
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endif

    </div>

@endsection