@extends('layouts.app')
@section('title', 'Income And Expense')
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
                    <h2>INCOME AND EXPENSE STETEMENTS</h2>
                    @if (auth()->user()->role == '0')
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#addModel"
                                class="btn btn-outline-primary flex-1 me-2">Add I&E Statement </button>
                            <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1">
                                                I&E RECORDING
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('income_expences.store') }}" method="POST">
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

                                                <div class="mb-3">
                                                    <label for="amount" class="control-label mb-2">Transaction
                                                        Type:</label>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" checked type="radio"
                                                            name="type" id="income" value="income">
                                                        <label class="form-check-label cursor-pointer"
                                                            for="income">Income</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="type"
                                                            id="expense" value="expense">
                                                        <label class="form-check-label cursor-pointer"
                                                            for="expense">Expense</label>
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
                    @endif
                </div>
                {{-- <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2 class="w-50"></h2>
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
                </div> --}}
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
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
        $(function() {
            $.ajax({
                url: "{{ route('api.incomeExpence') }}",
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
                                targets: 2,
                                render: function(data, type, row) {
                                    if (row.type === 'income') {
                                        return '<span class="badge fw-bold bg-info">Income</span>';
                                    } else {
                                        return '<span class="badge fw-bold bg-danger">Expenses</span>';
                                    }
                                }
                            },
                            {
                                targets: 3,
                                render: function(data, type, row) {
                                    return row.comment;
                                }
                            },
                            {
                                targets: 4,
                                render: function(data, type, row) {
                                    if (row.status === 'requested') {
                                        return '<span class="badge fw-semibold py-1 w-100 bg-secondary-subtle text-secondary">Requested</span>';
                                    } else if (row.status === 'approved') {
                                        return '<span class="badge fw-semibold py-1 w-100 bg-dark-subtle text-dark">Approved</span>';
                                    } else {
                                        return '<span class="badge fw-semibold py-1 w-100 bg-warning-subtle text-warning">Rejected</span>';
                                    }
                                }
                            }, {
                                targets: 5,
                                render: function(data, type, row) {
                                    return row.amount;
                                }
                            },
                        ],
                        scrollX: true,
                        order: [],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],

                    });
                }
            });
        });
    </script>
@endsection
