@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Promotions
    </h2>
    @php
        $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first()
    @endphp
    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

    <form method="post" action="{{ route('promotion.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Description</th>
                    <th>Due</th>
                    <th>Settled</th>
{{--                    <th>Variation</th>--}}
                    <th>Remarks</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td>
                        <select class="form-control" name="record[0][desc]">
                            <option value="">Select</option>
                            <option>Increment</option>
                            <option>Promotion</option>
                            <option>Promotion (Garden)</option>
                            <option>MACP</option>
                            <option>Retirement</option>
                            <option>Retirement (Garden)</option>
                            <option>Death</option>
                            <option>Compationate Appointment</option>
                        </select>
                    </td>
                    <td><input class="form-control" type="number" name="record[0][due]" /></td>
                    <td><input class="form-control" type="number" name="record[0][settled]" /></td>
{{--                    <td><input class="form-control" type="number" name="record[0][variation]" /></td>--}}
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
                <th>Description</th>
                <th>Due</th>
                <th>Settled</th>
                <th>Variation</th>
                <th>Remarks</th>
                @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                    <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($promotions as $promotion)
                <tr>
                    <td>{{$loop->index + 1}}.</td>
                    <td>{{$promotion->desc}}</td>
                    <td>{{$promotion->due}}</td>
                    <td>{{$promotion->settled}}</td>
                    <td>{{$promotion->variation}}</td>
                    <td>{{$promotion->remarks}}</td>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <td>
                            <form action="{{ route('promotion.dlt', [$promotion->id]) }}" method="post">
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
