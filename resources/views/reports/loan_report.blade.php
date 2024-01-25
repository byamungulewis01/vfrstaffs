@extends('layouts.app')
@section('title', 'Loan Report')
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
                    <h2 class="w-50">Loan Report </h2>
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
                            <th>Name of member</th>
                            <th>Loan Amount</th>
                            <th>Loan Term </th>
                            <th>Installment </th>
                            <th>Loan Balance </th>
                            <th>Last Payment Date </th>
                            <th>Days in arrears</th>
                            <th>Savings Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->loan }}</td>
                                <td>{{ $item->installement }}</td>
                                <td>
                                    @php
                                        $total = $item->loan + $item->iterest;
                                        $rounded = round($total / $item->installement);
                                    @endphp
                                    {{ $rounded }}
                                </td>
                                <td>
                                    {{ $item->loan + $item->iterest }}
                                </td>
                                <td>
                                    {{ @\App\Models\LoanPay::where('loan_id', $item->id)->latest()->first()->created_at }}
                                </td>
                                <td>
                                    @php
                                        @$lastPayment = \App\Models\LoanPay::where('loan_id', $item->id)
                                            ->latest()
                                            ->first()->created_at;
                                        $lastPaymentDate = \Carbon\Carbon::parse($lastPayment);
                                        $daysDifference = $lastPaymentDate->diffInDays(now());
                                        $date = $daysDifference >= 30 ? $daysDifference - 30 : 0;
                                    @endphp
                                    {{ $date }}
                                </td>
                                <td>
                                    @php
                                        $total = \App\Models\SavingMember::where('user_id', $item->user_id)
                                            ->where('status', 'approved')
                                            ->sum(\DB::raw('CASE WHEN type = "deposit" THEN amount ELSE -amount END'));
                                    @endphp
                                    {{ number_format($total) }}
                                </td>

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
