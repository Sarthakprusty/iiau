@extends('layout.main')


@section('title', 'correspondences')



@section('content')
    <div class="container-fluid">
        <h2>
            Report of Correspondences
        </h2>
        @php
            $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
        @endphp
        @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

            <form method="post" action="{{ route('correspondence.save') }}">
                @csrf
                <div class="card table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            {{--<th>Sl.</th>--}}
                            <th>Description</th>
                            <th>Received</th>
                            <th>Settled</th>
                            <th>Previous Due</th>
                            <th>Remarks</th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            {{--<td>1.</td>--}}

                            <td><textarea class="form-control" name="record[0][desc]" >{{ old('record.0.desc') }}</textarea></td>
                            <td><input class="form-control" type="number" name="record[0][rec]" value="{{ old('record.0.rec') }}"/></td>
                            <td><input class="form-control" type="number" name="record[0][settled]" value="{{ old('record.0.settled') }}"/></td>
                            <td><input class="form-control" type="number" name="record[0][prev_due]" value="{{ old('record.0.prev_due') }}"/></td>
                            <td><textarea class="form-control" name="record[0][remarks]" >{{ old('record.0.remarks') }}</textarea></td>

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
                    <th>Description</th>
                    <th>Received</th>
                    <th>Settled</th>
                    <th>Previous Due</th>
                    <th>Balance</th>
                    <th>Remarks</th>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <th>Action</th>
                    @endif
                </tr>

                </thead>
                <tbody>
                @foreach ($correspondences as $correspondence)
                    <tr>
                        {{--<td>{{$loop->index + 1}}.</td>--}}
                        <td>{{$correspondence->desc}}</td>
                        <td>{{$correspondence->rec}}</td>
                        <td>{{$correspondence->settled}}</td>
                        <td>{{$correspondence->prev_due}}</td>
                        <td>{{$correspondence->bal}}</td>
                        <td>{{$correspondence->remarks}}</td>
                        @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                            <td>
                                <form action="{{ route('correspondence.dlt', [$correspondence->id]) }}" method="post">
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
