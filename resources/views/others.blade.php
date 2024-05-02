@extends('layout.main')


@section('title', 'Others')



@section('content')
    <div class="container-fluid">
        <h2>
            Other Report
        </h2>
        @if(session('report_submitted')!=1)

            <form method="post" action="{{ route('others.save') }}">
                @csrf
                <div class="card table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            {{--<th>Sl.</th>--}}
                            <th>Title</th>
                            <th>Description</th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            {{--<td>1.</td>--}}
                            <td><input class="form-control" type="text" name="record[0][title]" required /></td>
                            <td><textarea class="form-control" type="number" name="record[0][desc]" required></textarea></td>
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
                    <th>Title</th>
                    <th>Description</th>
                    @if(session('report_submitted')!=1)
                        <th>Action</th>
                    @endif
                </tr>

                </thead>
                <tbody>
                @foreach ($Other as $o)
                    <tr>
                        <td>{{$loop->index + 1}}.</td>
                        <td>{{$o->title}}</td>
                        <td>{{$o->desc}}</td>
                        @if(session('report_submitted')!=1)
                            <td>
                                <form action="{{ route('others.dlt', [$o->id]) }}" method="post">
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
