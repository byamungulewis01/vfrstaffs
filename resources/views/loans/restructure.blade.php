@extends('layouts.app')
@section('title', 'Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>LOAN RESTRUCTURING APPROVING</h2>
                    <button data-bs-toggle="modal" data-bs-target="#approvalAllModel"
                        class="btn btn-outline-primary flex-1 me-2">Approve All</button>

                    <div class="modal fade" id="approvalAllModel" tabindex="-1" aria-labelledby="vertical-center-modal"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content modal-filled bg-light-primary">
                                <div class="modal-body p-4">
                                    <form action="{{ route('loan.restructure_approve_all') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-center text-primary">
                                            <h4 class="mt-2 text-primary">Are you sure to approve all ?</h4>
                                            <p class="mt-3">
                                                Please Ensure that you have read carefully the List of Terms and
                                                Conditions
                                            </p>
                                            <button class="btn btn-light my-2">
                                                Yes I'm sure
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>

                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Names</th>
                            <th scope="col">Loan</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Installment</th>
                            <th scope="col">Additional installement</th>
                            <th scope="col">Additional Amount</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            @php
                                $loan_pays = \App\Models\LoanPay::where('loan_id', $loan->loan_id)
                                    ->where('status', 'approved')
                                    ->get();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->loan->user->name }}</td>
                                <td>
                                    <span class="fs-2">Initial :
                                        <strong>{{ number_format($loan->loan->loan) }}</strong></span> <br>
                                    <span class="fs-2">Paid :
                                        <strong>{{ number_format($loan_pays->sum('amount')) }}</strong></span> <br>
                                    <span class="fs-2">Balance :
                                        <strong>{{ number_format($loan->loan->loan - $loan_pays->sum('amount')) }}</strong></span>
                                </td>
                                <td>
                                    <span class="fs-2">Initial :
                                        <strong>{{ number_format($loan->loan->interest) }}</strong></span> <br>
                                    <span class="fs-2">Paid :
                                        <strong>{{ number_format($loan_pays->sum('interest')) }}</strong></span> <br>
                                    <span class="fs-2">Balance :
                                        <strong>{{ number_format($loan->loan->interest - $loan_pays->sum('interest')) }}</strong></span>
                                </td>
                                <td>
                                    <span class="fs-2">Initial :
                                        <strong>{{ number_format($loan->loan->installement) }}</strong></span> <br>
                                    <span class="fs-2">Paid :
                                        <strong>{{ number_format($loan_pays->count()) }}</strong></span> <br>
                                    <span class="fs-2">Balance :
                                        <strong>{{ number_format($loan->loan->installement - $loan_pays->count()) }}</strong></span>
                                </td>
                                <td>{{ $loan->instrument }}</td>
                                <td>{{ number_format($loan->amount) }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#approvalModel{{ $loan->id }}">Approve</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#rejectModel{{ $loan->id }}">Reject</button>


                                    <div class="modal fade" id="approvalModel{{ $loan->id }}" tabindex="-1"
                                        aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content modal-filled bg-light-primary">
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('loan.restructure_approve', $loan->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="text-center text-primary">
                                                            <h4 class="mt-2 text-primary">You Are about to Approve</h4>
                                                            <p class="mt-3">
                                                                Please Ensure that you have read carefully the List of Terms
                                                                <br>
                                                                and Conditions
                                                            </p>
                                                            <button class="btn btn-light my-2">
                                                                Yes I'm sure
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>

                                    <div class="modal fade" id="rejectModel{{ $loan->id }}" tabindex="-1"
                                        aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content modal-filled bg-light-danger">
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('loan.restructure_reject', $loan->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="text-center text-danger">
                                                            <h4 class="mt-2 text-danger">Are you Sure Reject?</h4>
                                                            <p class="mt-3">
                                                                Please Ensure that you have read carefully the List of Terms
                                                                <br>
                                                                and Conditions
                                                            </p>
                                                            <button class="btn btn-light my-2">
                                                                Yes I'm sure
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>


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

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $('#datatable').DataTable();
        });
    </script>

@endsection
