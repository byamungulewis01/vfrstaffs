@extends('layouts.app')
@section('title', 'Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

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
                            $disable2 = '';

                            $loan_pay = \App\Models\LoanPay::where('loan_id', $loan->id)
                                ->latest()
                                ->first();
                            if (@$loan_pay->isPartial == true && @$loan_pay->penalty > 0) {
                                $disable2 = 'disabled';
                            }
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
                        @if (auth()->user()->role == '0')
                            @if ($loan->status == 'approved')
                                <div class="button-group">
                                    <button data-bs-toggle="modal" data-bs-target="#restructure" type="button"
                                        class="btn waves-effect {{ $disable }}{{ $disable2 }} waves-light btn-warning">
                                        Restructure
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#topup" type="button"
                                        class="btn waves-effect {{ $disable }}{{ $disable2 }}  waves-light btn-secondary">
                                        Topup
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#partial" type="button"
                                        class="btn waves-effect {{ $disable }} waves-light btn-danger">
                                        Partial Pay
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#addPayOff" type="button"
                                        class="btn waves-effect {{ $disable }}{{ $disable2 }}  waves-light btn-success">
                                        Pay Off
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#addQCL" type="button"
                                        class="btn waves-effect {{ $disable }}{{ $disable2 }}  waves-light btn-info">
                                        Add QCL
                                    </button>
                                    <div class="modal fade" id="addQCL" tabindex="-1"
                                        aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel1">
                                                        QUICK COVER LOAN
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('loan.storeQCL', $loan->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @php
                                                            $_loan = round($loan->loan / $loan->installement);
                                                            $interest = round($loan->interest / $loan->installement);
                                                            $total = $_loan + $interest;
                                                        @endphp
                                                        <div class="mb-3">
                                                            <label for="total" class="control-label mb-2">Total monthly
                                                                loan:</label>
                                                            <input type="text" readonly name="total"
                                                                value="{{ $total }}" class="form-control">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label for="amount"
                                                                    class="control-label mb-2">Loan:</label>
                                                                <input type="text" readonly name="amount"
                                                                    value="{{ $_loan }}" class="form-control">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="interest" class="control-label mb-2">Total
                                                                    Interest:</label>
                                                                <input type="text" readonly name="interest"
                                                                    value="{{ $interest }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comment"
                                                                class="control-label mb-2">Comment:</label>
                                                            <textarea name="comment" class="form-control" rows="2" placeholder="Text Here..."></textarea>
                                                            @error('comment')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button class="btn btn-success"> Submit </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                    <div class="modal fade" id="addPayOff" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel2">
                                                        LOAN PAY OFF
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('loan.storePayOff', $loan->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @php
                                                            $_loan = $loan->loan - $loan_pays->sum('amount');
                                                            $interest = $loan->interest - $loan_pays->sum('interest');
                                                            $total = $_loan + $interest * 0.5;
                                                        @endphp
                                                        <div class="mb-3">
                                                            <label for="total" class="control-label mb-2">Total monthly
                                                                loan:</label>
                                                            <input type="text" readonly name="total"
                                                                value="{{ $total }}" class="form-control">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label for="amount"
                                                                    class="control-label mb-2">Loan:</label>
                                                                <input type="text" readonly name="amount"
                                                                    value="{{ $_loan }}" class="form-control">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="interest" class="control-label mb-2">Total
                                                                    Interest:</label>
                                                                <input type="text" readonly name="interest"
                                                                    value="{{ $interest * 0.5 }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comment"
                                                                class="control-label mb-2">Comment:</label>
                                                            <textarea name="comment" class="form-control" rows="2" placeholder="Text Here..."></textarea>
                                                            @error('comment')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button class="btn btn-success"> Submit </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                    <div class="modal fade" id="partial" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel2">
                                                        PARTIAL COVER LOAN
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('loan.storePartialLoan', $loan->id) }}"
                                                    method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @php
                                                            $loan_pay = \App\Models\LoanPay::where('loan_id', $loan->id)
                                                                ->latest()
                                                                ->first();

                                                            if (@$loan_pay->isPartial == true && @$loan_pay->status == 'approved' && @$loan_pay->penalty > 0) {
                                                                $_loan = round($loan->loan / $loan->installement);

                                                                $penalty = 0;
                                                                $interest = 0;
                                                                $_total = $_loan - $loan_pay->amount;
                                                                $amount = $_loan - $loan_pay->amount;
                                                                $readonly = 'readonly';
                                                            } else {
                                                                $_loan = round($loan->loan / $loan->installement);
                                                                $penalty_rate = \App\Models\LoanSetting::where('isPenalty', true)->first()->rate;
                                                                $tt = ($loan->loan - $loan->p_loan) * $penalty_rate;
                                                                $penalty = $tt / 100;
                                                                $interest = round($loan->interest / $loan->installement);
                                                                $total = $_loan + $interest;
                                                                $amount = null;
                                                                $_total = null;
                                                                $readonly = '';
                                                            }

                                                        @endphp
                                                        <div class="mb-3">
                                                            <label for="total" class="control-label mb-2">Total monthly
                                                                loan:</label>
                                                            <input type="number" min="0"
                                                                max="{{ $total }}" {{ $readonly }}
                                                                name="total" value="{{ $_total }}"
                                                                id="total" class="form-control">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label for="penalty" class="control-label mb-2">Loan
                                                                    Penalty:</label>
                                                                <input type="text" readonly name="penalty"
                                                                    value="{{ $penalty }}" class="form-control">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="interest" class="control-label mb-2">Total
                                                                    Interest:</label>
                                                                <input type="text" readonly name="interest"
                                                                    value="{{ $interest }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="amount" class="control-label mb-2">Loan:</label>
                                                            <input type="text" readonly value="{{ $amount }}"
                                                                id="amount" name="amount" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comment"
                                                                class="control-label mb-2">Comment:</label>
                                                            <textarea name="comment" class="form-control" required rows="2" placeholder="Text Here..."></textarea>
                                                            @error('comment')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button class="btn btn-success"> Submit </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->

                                    <div class="modal fade" id="topup" tabindex="-1"
                                        aria-labelledby="exampleModalLabel3">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel3">
                                                        TOP UP
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('loan.topup', $loan->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf

                                                        <div class="col-md-12 mb-3">
                                                            <label for="amount" class="control-label mb-2">Total
                                                                Amount:</label>
                                                            <input type="text" name="amount" placeholder="Amount/Frw"
                                                                value="{{ old('amount') }}" class="form-control">
                                                            @error('amount')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="instrument" class="control-label mb-2">Additional
                                                                Instrument:</label>
                                                            <input type="text" name="instrument"
                                                                placeholder="Instrument" value="{{ old('instrument') }}"
                                                                class="form-control">
                                                            @error('instrument')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button class="btn btn-success"> Submit </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                    <div class="modal fade" id="restructure" tabindex="-1"
                                        aria-labelledby="exampleModalLabel4">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel4">
                                                        LOAN RESTRUCTURING
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('loan.restructure', $loan->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf

                                                        <div class="col-md-12">
                                                            <input type="hidden" name="amount" value="0">
                                                            <label for="instrument" class="control-label mb-2">Additional
                                                                Instrument:</label>
                                                            <input type="text" name="instrument"
                                                                placeholder="Instrument" value="{{ old('instrument') }}"
                                                                class="form-control">
                                                            @error('instrument')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button class="btn btn-success"> Submit </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->

                                </div>
                            @endif
                        @endif
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
                                <th scope="col">Reverse</th>
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
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#reverseModel{{ $loan_pay->id }}"><i
                                                class="ti ti-arrow-left"></i></button>
                                        <div class="modal fade" id="reverseModel{{ $loan_pay->id }}" tabindex="-1"
                                            aria-labelledby="vertical-center-modal" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content modal-filled bg-light-danger">
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('loan.reverse', $loan_pay->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="text-center text-danger">
                                                                <h4 class="mt-2 text-danger">Are you Sure Reverse?</h4>
                                                                <p class="mt-3">
                                                                    Please Ensure that you have read carefully <br>the List
                                                                    of
                                                                    Terms and Conditions
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
    </div>
@endsection
@section('script')

    @include('layouts.datatable_js')

    <script>
        $(function() {
            $('#datatable').DataTable({
                scrollX: true,
                order: [],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            });
        });
    </script>
    <script>
        $("#total").on("input", function() {
            var inputValue = parseInt($(this).val(), 10);
            var penalty = parseInt('{{ $penalty }}', 10);
            var interest = parseInt('{{ $interest }}', 10);

            var sum = penalty + interest;
            var loan = inputValue - sum;

            $('#amount').val(loan);

        });
    </script>
@endsection
