@extends('layouts.app')
@section('title', 'Journal Report')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('dist/datepicker/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2 class="w-50">Journal Report </h2>
                    <div class="example">
                        <form action="" method="get">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" autocomplete="off" class="form-control"
                                    value="{{ $_start ?: now()->format('m/d/Y') }}" name="start" />

                                <span class="input-group-text bg-primary b-0 text-white">TO</span>

                                <input type="text" autocomplete="off" class="form-control"
                                    value="{{ $_end ?: now()->format('m/d/Y') }}" name="end" />
                                <button class="btn btn-primary ">Search</button>

                            </div>
                        </form>
                    </div>
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th>N<sup>0</sup></th>
                            <th>Post Date</th>
                            <th>Value Date</th>
                            <th>Account Number</th>
                            <th>Countra Account </th>
                            <th>Account Name</th>
                            <th>Narrative</th>
                            <th>Dr/Cr</th>
                            <th>Amount posted</th>
                            <th>PostedBy</th>
                            <th>ApprovedBy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journal_reports as $item)
                            @php
                                if ($item->source == 'saving') {
                                    # code...
                                    @$post_date = App\models\SavingMember::find($item->tranking)->created_at;
                                    @$member_name = \App\Models\SavingMember::find($item->tranking)->user->name;
                                    @$member_regnumber = \App\Models\SavingMember::find($item->tranking)->user->regnumber;
                                    @$posted_by = \App\Models\SavingMember::find($item->tranking)->_saving->user->name;
                                    @$approved_by = \App\Models\SavingMember::find($item->tranking)->approval->name;
                                } elseif ($item->source == 'other') {
                                    # code...
                                    // @$post_date = App\models\IncomeExpence::find($item->tranking)->created_at->format('Y-m-d');
                                    @$member_name = \App\Models\IncomeExpence::find($item->tranking)->user->name;
                                    @$member_regnumber = \App\Models\IncomeExpence::find($item->tranking)->user->regnumber;
                                    @$posted_by = \App\Models\IncomeExpence::find($item->tranking)->user->name;
                                    @$approved_by = \App\Models\IncomeExpence::find($item->tranking)->approval->name;
                                } elseif ($item->source == 'loan' && $item->isLoan == true) {
                                    # code...
                                    @$post_date = App\models\Loan::find($item->tranking)->created_at;
                                    @$member_name = \App\Models\Loan::find($item->tranking)->user->name;
                                    @$member_regnumber = \App\Models\Loan::find($item->tranking)->user->regnumber;
                                    @$posted_by = \App\Models\Loan::find($item->tranking)->posted->name;
                                    @$approved_by = \App\Models\Loan::find($item->tranking)->approval->name;
                                } else {
                                    @$post_date = App\models\LoanPay::find($item->tranking)->created_at;
                                    @$member_name = \App\Models\LoanPay::find($item->tranking)->loan->user->name;
                                    @$member_regnumber = \App\Models\LoanPay::find($item->tranking)->loan->user->regnumber;
                                    @$posted_by = \App\Models\LoanPay::find($item->tranking)->loan->posted->name;
                                    @$approved_by = \App\Models\LoanPay::find($item->tranking)->approval->name;
                                    # code...
                                }

                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post_date }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>

                                <td>{{ $item->account_number }}</td>
                                <td>{{ $member_regnumber }}</td>
                                <td>{{ $member_name }}</td>
                                <td>{{ $item->comment }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ !$posted_by ? 'Unknown User' : $posted_by }}</td>
                                <td>{{ !$approved_by ? 'Unknown User' : $approved_by }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dist/datepicker/moment.js') }}"></script>
    <script src="{{ asset('dist/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        jQuery("#date-range").datepicker({
            toggleActive: true,
            endDate: '0d',
        });
    </script>
    <!-- ---------------------------------------------- -->
    @include('layouts.datatable_js')
    <script>
        $('#datatable').DataTable({
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    </script>

@endsection
