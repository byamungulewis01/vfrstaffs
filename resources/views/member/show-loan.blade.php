@extends('layouts.app')
@section('title', 'My Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">

        <div class="row">
            <div class="col-lg-6">
                <div class="card w-100">
                    <div class="card-body">
                        <table class="table align-middle text-nowrap mb-3" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>REG NUMBER</th>
                                    <th><span class="text-muted">{{ $loan->user->regnumber }}</span></th>
                                </tr>
                                <tr>
                                    <th>NAMES</th>
                                    <th><span class="text-muted">{{ $loan->user->name }}</span></th>
                                </tr>
                                <tr>
                                    <th>PHONE NUMBER</th>
                                    <th><span class="text-muted">{{ $loan->user->phone }}</span></th>
                                </tr>
                                <tr>
                                    <th>LOAN TYPE</th>
                                    <th><span class="text-muted">{{ $loan->loan_setting->name }}</span></th>
                                </tr>
                                <tr>
                                    <th>DISBURSEMENT DATE</th>
                                    <th><span class="text-muted">{{ $loan->created_at->format('Y/m/d') }}</span></th>
                                </tr>
                                <tr>
                                    <th>INSTALLEMENT</th>
                                    <th><span class="text-muted">{{ $loan->installement }}</span></th>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Yearly Breakup -->
                <div class="card">
                    <div class="card-body">
                        <table class="table align-middle text-nowrap mb-1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white">TOTAL LOAN</th>
                                    <th class="bg-primary text-white">LOAN</th>
                                    <th class="bg-primary text-white">INTEREST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $loan->loan + $loan->interest }}</td>
                                    <td>{{ $loan->loan }}</td>
                                    <td>{{ $loan->interest }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table align-middle text-nowrap mb-1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="bg-warning text-white">TOTAL PAYED LOAN</th>
                                    <th class="bg-warning text-white">PAYEDLOAN</th>
                                    <th class="bg-warning text-white">PAYED INTEREST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $loan_pays->sum('amount') + $loan_pays->sum('interest') }}</td>
                                    <td>{{ $loan_pays->sum('amount') }}</td>
                                    <td>{{ $loan_pays->sum('interest') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @php
                            $t_loan = $loan->loan + $loan->interest;
                            $t_remain = $loan_pays->sum('amount') + $loan_pays->sum('interest');
                            $disable = $loan->loan == $loan_pays->sum('amount') ? 'disabled' : '';
                        @endphp
                        <table class="table align-middle text-nowrap mb-1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="bg-success text-white">TOTAL BALANCE</th>
                                    <th class="bg-success text-white">BALANCE LOAN</th>
                                    <th class="bg-success text-white">BALANCE INTEREST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $t_loan - $t_remain }}</td>
                                    <td>{{ $loan->loan - $loan_pays->sum('amount') }}</td>
                                    <td>{{ $loan->interest - $loan_pays->sum('interest') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="card mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Transactions

                        </h4>
                    </div>
                    <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Loan</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $print = 0;
                                $temp = $loan->loan + $loan->interest;
                                $p = 0;
                            @endphp
                            @foreach ($loan_pays as $loan_pay)
                                @php
                                    $print = $temp - $p;
                                    $temp = $print;
                                    $p = $loan_pay->amount + $loan_pay->interest;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan_pay->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $print }}</td>
                                    <td>{{ $p }}</td>
                                    <td>{{ $loan_pay->comment }}</td>
                                    <td>
                                        @if ($loan_pay->status == 'requested')
                                            <span
                                                class="badge fw-semibold py-1 w-100 bg-secondary-subtle text-secondary">Requested</span>
                                        @elseif($loan_pay->status == 'approved')
                                            <span
                                                class="badge fw-semibold py-1 w-100 bg-dark-subtle text-dark">Approved</span>
                                        @else
                                            <span
                                                class="badge fw-semibold py-1 w-100 bg-warning-subtle text-warning">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $print - $p }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
