@extends('layouts.app')
@section('title', 'Income And Expense')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>INCOME AND EXPENSE STETEMENTS</h2>
                </div>
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

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $.ajax({
                url: "{{ route('api.monthlyIncomeExpence') }}",
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

                    });
                }
            });
        });
    </script>
@endsection
