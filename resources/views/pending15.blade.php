@extends('layout.main')


@section('title', 'Pending beyond 15 days')



@section('content')
    <div class="container-fluid">
        <h2>
            Report of Disposal of Work
        </h2>
        @if(session('report_submitted')!=1)

            <form method="post" action="{{ route('pending15.save') }}">
                @csrf
                <div class="card table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            {{--<th>Sl.</th>--}}
                            <th>Description</th>
                            <th>Pending with Reasons</th>
                            <th>Action Taken/Proposed</th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            {{--<td>1.</td>--}}

                            <td><input class="form-control" type="text" name="record[0][desc]" required /></td>
                            <td><textarea class="form-control" type="number" name="record[0][reason]" required></textarea></td>
                            <td><textarea class="form-control" type="number" name="record[0][action]" required></textarea></td>
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

                    <th>SL</th>
                    <th>description</th>
                    <th>Pending with Reasons</th>
                    <th>Action Taken/Proposed</th>
                    @if(session('report_submitted')!=1)
                        <th>Action</th>
                    @endif
                </tr>

                </thead>
                <tbody>
                @foreach ($pending15 as $p15)
                    <tr>
                        <td>{{$loop->index + 1}}.</td>
                        <td>{{$p15->desc}}</td>
                        <td>{{$p15->reason}}</td>
                        <td>{{$p15->action}}</td>
                        @if(session('report_submitted')!=1)
                            <td>
                                <form action="{{ route('pending15.dlt', [$p15->id]) }}" method="post">
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
