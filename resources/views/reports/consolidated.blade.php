@extends('layout.blank')


@section('title', 'ConsolidatedReport')

@section('content')
    <div style="width: 100%; text-align: center">
        PRESIDENT'S SECRETARIAT<br/>
        IIAU
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
                    <td class="text">{{$work->section_name}}</td>
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
