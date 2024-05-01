@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container">
    <h2>
        Dashboard
    </h2>
    <form action="{{route('dashboard.find')}}" method="POST">

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
                    Status of {{session('month')}}/{{session('year')}}
                </div>
                <div class="card-body">

                    <div class="row">
                        @foreach($data as $key=>$value)
                            <div class="col-md-4">
                                @if(isset($data[$key]) && $data[$key]['cnt']>0)
                                    <div class="card border-primary mb-3" >
                                        @else
                                            <div class="card border-default mb-3" >
                                                @endif

                                                <div class="card-body">
                                                    <h3>{{$value['desc']}}</h3>
                                                    @if(isset($data[$key]) && $data[$key]['cnt']>0)
                                                        last updated at: {{$data[$key]['last_updated']}}
                                                    @else
                                                        Not yet updated
                                                    @endif
                                                </div>
                                                <div class="card-footer">
                                                    @if(session('report_submitted'))
                                                        <a href="{{ route($key) }}" class="btn btn-primary float-md-end">View</a>
                                                    @else
                                                        <a href="{{ route($key) }}" class="btn btn-primary float-md-end">Update</a>
                                                    @endif

                                                </div>
                                            </div>
                                    </div>
                        @endforeach
                    </div>
                </div>
                    <div class="card-footer">
                        @if(session('report_submitted')==1)
                            Report submitted at {{session('report_submitted_at')}}

                        @else
                            <form action="{{route('report.save')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger float-md-end">Forward</button>
                            </form>
                        @endif

                    </div>
            </div>

        </div>
    </div>
    @endif

</div>
@endsection
