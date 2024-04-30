@extends('layout.main')


@section('title', 'Bills')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Disposal of Work
    </h2>
    @if(session('report_submitted')!=1)

    <form method="post" action="{{ route('bill.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Received</th>
                    <th>Settled</th>
                    <th>Previous Due</th>
                    <th>Remarks</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}

                    <td><input class="form-control" type="number" name="record[0][rec]" /></td>
                    <td><input class="form-control" type="number" name="record[0][settled]" /></td>
                    <td><input class="form-control" type="number" name="record[0][prev_due]" /></td>
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
                <th>Received</th>
                <th>Settled</th>
                <th>Previous Due</th>
                <th>Balance</th>
                <th>Remarks</th>
                @if(session('report_submitted')!=1)
                <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($bills as $bill)
                <tr>
                    {{--<td>{{$loop->index + 1}}.</td>--}}
                    <td>{{$bill->rec}}</td>
                    <td>{{$bill->settled}}</td>
                    <td>{{$bill->prev_due}}</td>
                    <td>{{$bill->bal}}</td>
                    <td>{{$bill->remarks}}</td>
                    @if(session('report_submitted')!=1)
                    <td>
                        <form action="{{ route('bill.dlt', [$bill->id]) }}" method="post">
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
