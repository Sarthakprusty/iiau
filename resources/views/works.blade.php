@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Disposal of Work
    </h2>
    @if(session('report_submitted')!=1)
    <form method="post" action="/works">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Name</th>
                    <th>BF</th>
                    <th>Recd.</th>
                    <th>Disposed</th>
                    <th>Balance</th>
                    <th>Pending >1 mnth</th>
                    <th>Pending >3 mnths</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td><input class="form-control" type="text" name="record[0][desc]" /></td>
                    <td><input class="form-control" type="number" name="record[0][bf]" /></td>
                    <td><input class="form-control" type="number" name="record[0][recd]" /></td>
                    <td><input class="form-control" type="number" name="record[0][disp]" /></td>
                    <td><input class="form-control" type="number" name="record[0][bal]" /></td>
                    <td><input class="form-control" type="number" name="record[0][p1m]" /></td>
                    <td><input class="form-control" type="number" name="record[0][p3m]" /></td>

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
                <th>BF</th>
                <th>Recd.</th>
                <th>Disposed</th>
                <th>Balance</th>
                <th>Pending >1 mnth</th>
                <th>Pending >3 mnths</th>
                @if(session('report_submitted')!=1)
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
                    <td>{{$work->pending_1}}</td>
                    <td>{{$work->pending_3}}</td>
                    @if(session('report_submitted')!=1)
                        <td>
                            <form action="/works/{{$work->id}}" method="post">
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
