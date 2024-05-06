@extends('layout.main')


@section('title', 'Ubiforms')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Uniforms
    </h2>
    @php
        $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
    @endphp
    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

    <form method="post" action="{{ route('uniform.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Description</th>
                    <th>CutOff Date</th>
                    <th>Status</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td><input class="form-control" type="text" name="record[0][description]" required/></td>
                    <td><input class="form-control" type="date" name="record[0][cut_off_date]" /></td>
                    <td><input class="form-control" type="text" name="record[0][status]" required /></td>
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
                <th>Description</th>
                <th>CutOff Date</th>
                <th>Status</th>
                @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                    <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($uniforms as $uniform)
                <tr>
                    <td>{{$loop->index + 1}}.</td>
                    <td>{{$uniform->description}}</td>
                    <td>{{$uniform->cut_off_date}}</td>
                    <td>{{$uniform->status}}</td>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <td>
                            <form action="{{ route('uniform.dlt', [$uniform->id]) }}" method="post">
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
