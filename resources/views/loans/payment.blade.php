@extends('layouts.app')
@section('title', 'Loan Payment')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card w-100 position-relative overflow-hidden mb-0">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Loan payment</h5>
                <p class="card-subtitle mb-4">Monthly Loan payment for <span class="text-warning">{{ date('F-Y') }}</span>
                </p>
                <form action="{{ route('loan.store_payment') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-4 gap-3">
                                <div class="w-75">
                                    <input type="text" required name="comment" autocomplete="off" class="form-control"
                                        id="exampleInputtext2" placeholder="Loan Comment .....">
                                </div>
                                <button class="btn btn-primary w-25">Qucky Cover Loan</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="">
                                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Member ID</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Loan</th>
                                            <th scope="col">Interest</th>
                                            <th scope="col">Total Loan</th>
                                            <th scope="col">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loans as $loan)
                                            @php
                                                $_loan = round($loan->loan / $loan->installement);
                                                $interest = round($loan->interest / $loan->installement);
                                                $total = $_loan + $interest;
                                                $loan_pay = \App\Models\LoanPay::where('loan_id', $loan->id)
                                                    ->where('status', 'requested')->first();
                                            @endphp
                                            @if ($loan_pay)
                                                @continue
                                            @else
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $loan->user->regnumber }}</td>
                                                    <td>{{ $loan->user->name }}</td>
                                                    <td>{{ $_loan }}</td>
                                                    <td>{{ $interest }}</td>
                                                    <td>{{ $total }}</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="members[]" type="checkbox"
                                                                checked value="{{ $loan->id }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $('#datatable').DataTable();
    </script>
@endsection
