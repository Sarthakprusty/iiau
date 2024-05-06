@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container-fluid">
    <h2>
        Report of References pending with Central/State Government Offices
    </h2>
    @php
        $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
    @endphp
    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

    <form method="post" action="{{ route('references.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Authority to whom<br/>a reference has been made</th>
                    <th>Date of<br/>Communication</th>
                    <th>Date of<br/>Reply</th>
                    <th>Date of<br/>Reminder or Action taken</th>
                    <th>Remarks</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td><input class="form-control" type="text" name="record[0][desc]" /></td>
                    <td><input class="form-control" type="date" name="record[0][date_of_comm]" /></td>
                    <td><input class="form-control" type="date" name="record[0][date_of_reply]" /></td>
                    <td><input class="form-control" type="date" name="record[0][date_of_action]" /></td>
                    <td><textarea class="form-control" name="record[0][remarks]"></textarea></td>

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
                <th>Authority to whom<br/>a reference has been made</th>
                <th>Date of<br/>Communication</th>
                <th>Date of<br/>Reply</th>
                <th>Date of<br/>Reminder or Action taken</th>
                <th>Remarks</th>
                @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                    <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($references as $reference)
                <tr>
                    <td>{{$loop->index + 1}}.</td>
                    <td>{{$reference->desc}}</td>
                    <td>{{$reference->date_of_comm}}</td>
                    <td>{{$reference->date_of_reply}}</td>
                    <td>{{$reference->date_of_action}}</td>
                    <td>{{$reference->remarks}}</td>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <td>
                            <form action="{{ route('references.dlt', [$reference->id]) }}" method="post">
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
