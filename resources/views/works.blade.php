@extends('layout.main')


@section('title', 'Dashboard')



@section('content')
<div class="container-fluid">
    <h2>
        Report of Disposal of Work
    </h2>
    @php
        $report = \App\Models\Report::where('section_id', auth()->user()->section_id)->where('year',session('year'))->where('month',session('month'))->first();
     $bills= \App\Models\Bill::all();
        $receipts= \App\Models\Receipt::all();
    @endphp
    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))

    <form method="post" action="{{ route('work.save') }}">
        @csrf
        <div class="card table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    {{--<th>Sl.</th>--}}
                    <th>Name</th>
                    <th>Task</th>
                    <th>Task type</th>
                    <th>Opening Balance</th>
                    <th>Recd.</th>
                    <th>Disposed</th>
                    <!--<th>Balance</th>-->
                    <th>Pending >15 days</th>
                    <th>Pending >30 days</th>
                    <th>Pending >60 days</th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    {{--<td>1.</td>--}}
                    <td><input class="form-control" type="text" name="record[0][desc]" value="{{ old('record.0.desc') }}"></td>
                    <td>
                        <div class="form-group">
                            <select id="action" name="record[0][action]" class="form-control" required>
                                <option value="bills"{{ old('record.0.action') == 'bills' ? ' selected' : '' }}>Bills</option>
                                <option value="receipts"{{ old('record.0.action') == 'receipts' ? ' selected' : '' }}>Receipts</option>
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <select id="bill_receipt_desc" name="record[0][bill_receipt_desc]" class="form-control" required>

                            </select>
                        </div>
                    </td>

                    <td><input class="form-control" type="number" name="record[0][bf]" value="{{ old('record.0.bf') }}"></td>
                    <td><input class="form-control" type="number" name="record[0][recd]" value="{{ old('record.0.recd') }}"></td>
                    <td><input class="form-control" type="number" name="record[0][disp]" value="{{ old('record.0.disp') }}"></td>
                    <!--<td><input class="form-control" type="number" name="record[0][bal]" value="{{ old('record.0.bal') }}"></td>-->
                    <td><input class="form-control" type="number" name="record[0][p15d]" value="{{ old('record.0.p15d') }}"></td>
                    <td><input class="form-control" type="number" name="record[0][p30d]" value="{{ old('record.0.p30d') }}"></td>
                    <td><input class="form-control" type="number" name="record[0][p60d]" value="{{ old('record.0.p60d') }}"></td>


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
                <th>Task</th>
                <th>Task type</th>
                <th>Opening Balance</th>
                <th>Recd.</th>
                <th>Disposed</th>
                <th>Closing Balance</th>
                <th>Pending >15 days</th>
                <th>Pending >30 days</th>
                <th>Pending >60 days</th>
                @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                    <th>Action</th>
                @endif
            </tr>

            </thead>
            <tbody>
            @foreach ($works as $work)
                <tr>
                    <td>{{$loop->index + 1}}.</td>
                    <td>{{$work->desc}}</td>
                    <td>{{$work->action}}</td>
                    <td>{{$work->bill_receipt_desc}}</td>
                    <td>{{$work->brought_forward}}</td>
                    <td>{{$work->received}}</td>
                    <td>{{$work->disposed}}</td>
                    <td>{{$work->balance}}</td>
                    <td>{{$work->pending_15}}</td>
                    <td>{{$work->pending_30}}</td>
                    <td>{{$work->pending_60}}</td>
                    @if(session('report_submitted')!=1 || ($report && $report->statuses->first() && $report->statuses()->where('report_status.active', 1)->pluck('status_id')->contains(1)))
                        <td>
                            <form action="{{ route('work.dlt', [$work->id]) }}" method="post">
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
    <script>
        // Function to populate bill_receipt_desc dropdown based on the selected action
        function populateBillReceiptDescDropdown(action) {
            var billReceiptDescDropdown = document.getElementById("bill_receipt_desc");
            billReceiptDescDropdown.innerHTML = ""; // Clear existing options

            // Populate options based on selection
            var data;
            if (action === "bills") {
                data = <?php echo json_encode($bills); ?>;
            } else if (action === "receipts") {
                data = <?php echo json_encode($receipts); ?>;
            }

            // Populate options
            data.forEach(function(item) {
                var option = document.createElement("option");
                option.text = item.desc; // Assuming 'desc' is the column containing the description
                // billReceiptDescDropdown.add(option);
                if (item.desc === oldSelectedValue) { // Corrected from item.text
                    option.selected = true; // Select the option if its value matches the old selected value
                }
                billReceiptDescDropdown.add(option);
            });
        }

        // Event listener for change in the action dropdown
        document.getElementById("action").addEventListener("change", function() {
            var action = this.value;
            populateBillReceiptDescDropdown(action,''); // Populate bill_receipt_desc dropdown based on selected action
        });

        // Initial population of bill_receipt_desc dropdown based on the initial value of the action dropdown
        var initialAction = document.getElementById("action").value;
        var oldSelectedValue = '{{ old('record.0.bill_receipt_desc') }}'; // Get the old value from PHP
        populateBillReceiptDescDropdown(initialAction, oldSelectedValue);

    </script>
</div>
@endsection
