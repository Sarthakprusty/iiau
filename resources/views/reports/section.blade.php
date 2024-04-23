@extends('layout.blank')


@section('title', 'SectionReport')

@section('content')
    <div style="width: 100%; text-align: center">
        PRESIDENT'S SECRETARIAT<br/>
        {{$section->section_name}}
    </div>
    <div style="width: 100%; text-align: right">
    Dated:{{date_format($report[0]->created_at,'d/m/Y')}}
    </div>
    <div class="report">
        <h2>Work Report for {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Name</th>
                <th>BF</th>
                <th>Recd.</th>
                <th>Disposed</th>
                <th>Balance</th>
                <th>Pending<br/>>1 mnth</th>
                <th>Pending<br/>>3 mnths</th>
            </tr>
            </thead>
            <tbody>
            @php
                $t_brought_forward = 0;
                $t_received = 0;
                $t_disposed = 0;
                $t_balance = 0;
                $t_pending_1 = 0;
                $t_pending_3 = 0;
            @endphp
            @foreach ($data['works']['data'] as $work)
                <tr>
                    <td class="number">{{$loop->index + 1}}</td>
                    <td class="text">{{$work->desc}}</td>
                    <td class="number">{{$work->brought_forward}}</td>
                    <td class="number">{{$work->received}}</td>
                    <td class="number">{{$work->disposed}}</td>
                    <td class="number">{{$work->balance}}</td>
                    <td class="number">{{$work->pending_1}}</td>
                    <td class="number">{{$work->pending_3}}</td>
                </tr>
                @php
                    $t_brought_forward += $work->brought_forward;
                    $t_received += $work->received;
                    $t_disposed += $work->disposed;
                    $t_balance = $work->balance;
                    $t_pending_1 = $work->pending_1;
                    $t_pending_3 = $work->pending_3;
                @endphp
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>{{$t_brought_forward}}</th>
                <th>{{$t_received}}</th>
                <th>{{$t_disposed}}</th>
                <th>{{$t_balance}}</th>
                <th>{{$t_pending_1}}</th>
                <th>{{$t_pending_3}}</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="report">
        <h2>Bills Processed in {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Received</th>
                <th>Settled</th>
                <th>Previous Due</th>
                <th>Balance</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($data['bills']['data'] as $work)
                <tr>
                    <td class="text">{{$work->rec}}</td>
                    <td class="number">{{$work->settled}}</td>
                    <td class="number">{{$work->prev_due}}</td>
                    <td class="number">{{$work->bal}}</td>
                    <td class="number">{{$work->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="report">
        <h2>Promotions, Retirements etc in {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Description</th>
                <th>Due</th>
                <th>Settled</th>
                <th>Variation</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($data['promotions']['data'] as $work)
                <tr>
                    <td class="text">{{$work->desc}}</td>
                    <td class="number">{{$work->due}}</td>
                    <td class="number">{{$work->settled}}</td>
                    <td class="number">{{$work->variation}}</td>
                    <td class="number">{{$work->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="report">
        <h2>Communications in {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Description</th>
                <th>Date of Communication</th>
                <th>Date of Reply</th>
                <th>Date of Action</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data['references']['data'] as $work)
                <tr>
                    <td class="text">{{$work->desc}}</td>
                    <td class="number">{{$work->date_of_comm}}</td>
                    <td class="number">{{$work->date_of_reply}}</td>
                    <td class="number">{{$work->date_of_action}}</td>
                    <td class="number">{{$work->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="report">
        <h2>Status of Uniforms in {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Description</th>
                <th>Cutoff Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data['uniforms']['data'] as $work)
                <tr>
                    <td class="text">{{$work->description}}</td>
                    <td class="number">{{$work->cut_off_date}}</td>
                    <td class="number">{{$work->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="report">
        <h2>Bills pending for more than 15 days in {{$month}}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid;">
            <thead>
            <tr>
                <th>Description</th>
                <th>Reason</th>
                <th>Action Taken</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($data['pending15']['data'] as $work)
                <tr>
                    <td class="text">{{$work->desc}}</td>
                    <td class="text">{{$work->reason}}</td>
                    <td class="text">{{$work->action}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div style="text-align: right">
        Prepared By<br/>
        SO,{{$section->section_name}}
    </div>
@endsection
