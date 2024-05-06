@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Disposal of Work
    </h2>
    @php
        $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
    @endphp
    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

    <form method="post" action="{{ route('work.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Name</th>
                    <th>Opening Balance</th>
                    <th>Recd.</th>
                    <th>Disposed</th>
                    <!--<th>Balance</th>-->
                    <th>Pending >15 days</th>
                    <th>Pending >30 days</th>
                    <th>Pending >60 days</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td><input class="form-control" type="text" name="record[0][desc]" /></td>
                    <td><input class="form-control" type="number" name="record[0][bf]" /></td>
                    <td><input class="form-control" type="number" name="record[0][recd]" /></td>
                    <td><input class="form-control" type="number" name="record[0][disp]" /></td>
                    <!--<td><input class="form-control" type="number" name="record[0][bal]" /></td>-->
                    <td><input class="form-control" type="number" name="record[0][p15d]" /></td>
                    <td><input class="form-control" type="number" name="record[0][p30d]" /></td>
                    <td><input class="form-control" type="number" name="record[0][p60d]" /></td>

                </tr>
                </tbody>
            </table>
            <div class="card-footer">
                <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    @endif
    <div class="card table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Name</th>
                <th>Opening Balance</th>
                <th>Recd.</th>
                <th>Disposed</th>
                <th>Closing Balance</th>
                <th>Pending >15 days</th>
                <th>Pending >30 days</th>
                <th>Pending >60 days</th>
                @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                    <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($works as $work)
                <tr>
                    <td>{{$loop->index + 1}}.</td>
                    <td>{{$work->desc}}</td>
                    <td>{{$work->brought_forward}}</td>
                    <td>{{$work->received}}</td>
                    <td>{{$work->disposed}}</td>
                    <td>{{$work->balance}}</td>
                    <td>{{$work->pending_15}}</td>
                    <td>{{$work->pending_30}}</td>
                    <td>{{$work->pending_60}}</td>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <td>
                            <form action="{{ route('work.dlt', [$work->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-block btn-danger">DELETE</button>
                            </form>

                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection