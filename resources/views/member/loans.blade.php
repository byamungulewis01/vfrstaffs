@extends('layouts.app')
@section('title', 'Member Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>ACTIVE LOANS MANAGEMENT</h2>
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#addModel"
                                class="btn btn-outline-primary flex-1 me-2">Loan request</button>
                            <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1">
                                                Member Savings Transaction
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('member.store_loan') }}" method="POST">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="amount" class="control-label mb-2">Amount:</label>
                                                    <input type="number" min="1" name="amount"
                                                        value="{{ old('amount') }}" class="form-control" id="amount"
                                                        placeholder="Enter Amount" required autocomplete="off">
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label for="loan_type" class="control-label mb-2">Loan Type:</label>
                                                        <select name="loan_type" class="form-select" id="loan_type">
                                                            <option value="">Select Loan Type</option>
                                                            @foreach ($loanTypes as $loanType)
                                                                <option value="{{ $loanType->id }}">{{ $loanType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('loan_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="installement" class="control-label mb-2">Payment
                                                            Installement:</label>
                                                        <input type="installement" min="1" name="installement"
                                                            value="{{ old('installement') }}" class="form-control"
                                                            id="installement" placeholder="Number Of payment Installement"
                                                            required autocomplete="off">
                                                        @error('installement')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comment" class="control-label mb-2">Comment:</label>
                                                    <textarea name="comment" class="form-control" rows="4" placeholder="Text Here..."></textarea>
                                                    @error('comment')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-danger text-danger font-medium"
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
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Loan</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Total (L+I)</th>
                            <th scope="col">Terms</th>
                            <th scope="col">Inst</th>
                            <th scope="col">Payed</th>
                            <th scope="col">Remain</th>
                            <th scope="col">Date</th>
                            <th scope="col">LT</th>
                            <th scope="col">ML View</th>
                        </tr>
                    </thead>
                    <tbody>
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
            $.ajax({
                url: "{{ route('member.loans') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('#datatable').DataTable({
                        data: data,

                        columnDefs: [

                            {
                                targets: 0,
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, {
                                targets: 1,
                                render: function(data, type, row) {
                                    return row.loan;
                                }
                            }, {
                                targets: 2,
                                render: function(data, type, row) {
                                    return row.interest;
                                }
                            },
                            {
                                targets: 3,
                                render: function(data, type, row) {
                                    return row.loan + row.interest;
                                }
                            }, {
                                targets: 4,
                                render: function(data, type, row) {
                                    return row.installement;
                                }
                            }, {
                                targets: 5,
                                render: function(data, type, row) {
                                    var total = row.loan + row.interest;
                                    var rounded = Math.round(total / row.installement);
                                    return rounded;
                                }
                            }, {
                                targets: 6,
                                render: function(data, type, row) {
                                    var loanPays = row.loan_pays;
                                    var sumOfAmounts = loanPays.reduce(function(
                                        accumulator, currentValue) {
                                        return accumulator + (currentValue
                                        .amount + currentValue
                                        .interest);
                                    }, 0);
                                    return sumOfAmounts;
                                }
                            }, {
                                targets: 7,
                                render: function(data, type, row) {
                                    var total = row.loan + row.interest;
                                    var loanPays = row.loan_pays;

                                    var sumOfAmounts = loanPays.reduce(function(
                                        accumulator, currentValue) {
                                        return accumulator + (currentValue
                                        .amount + currentValue
                                        .interest);
                                    }, 0);
                                    return total-sumOfAmounts;

                                }
                            }, {
                                targets: 8,
                                render: function(data, type, row) {
                                    const originalDate = new Date(row.created_at);

                                    // Extract the components of the date
                                    const year = originalDate.getFullYear();
                                    const month = String(originalDate.getMonth() + 1)
                                        .padStart(2,
                                        '0'); // Months are zero-based, so add 1
                                    const day = String(originalDate.getDate()).padStart(
                                        2, '0');
                                    const formattedDate = `${year}/${month}/${day}`;
                                    return formattedDate;
                                }
                            }, {
                                targets: 9,
                                render: function(data, type, row) {
                                    return row.loan_setting.rate + ' %';
                                }
                            }, {
                                targets: 10,
                                render: function(data, type, row) {
                                    var route =
                                        "{{ route('member.show_loan', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a href="${route}" class="btn btn-primary btn-sm">View</a>`;
                                }
                            }
                        ],
                        scrollX: true,
                        order: [],

                    });
                }
            });
        });
    </script>
@endsection
