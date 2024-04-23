@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
    <div class="container">
        <h2>
            Dashboard
        </h2>
        <form action="/ifa-dashboard" method="POST">

            <div class="row">

                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            Report for Month
                        </div>
                        <div class="card-body">
                            @csrf
                            <input type="month" id="report_month" name="report_month" class="form-control" value="{{session('year')}}-{{session('month')}}" />
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-md-end">FETCH</button>
                            </div>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Section</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $section)
                                <tr>
                                    <td>{{$loop->index + 1}}.</td>
                                    <td>{{$section->section_name}}</td>
                                    <td>
                                        @if(sizeof($section->reports))
                                            <a href="/report/{{session('year')}}/{{session('month')}}/{{$section->id}}" class="btn btn-success">View Report</a><br/>
                                            {{date_format($section->reports[0]->created_at,'d/m/Y H:i:s')}}
                                        @else
                                            Not Submitted
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            <a href="/report/{{session('year')}}/{{session('month')}}/consolidated" class="btn btn-primary">View Complete Report</a>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>
@endsection
