@extends('layouts.app')
@section('title', 'Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>ACTIVE LOANS MANAGEMENT</h2>

                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
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
    @include('layouts.datatable_js')

    <script>
        $(function() {
            $.ajax({
                url: "{{ route('loan.index') }}",
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
                                    return row.user.regnumber;
                                }
                            }, {
                                targets: 2,
                                render: function(data, type, row) {
                                    return row.user.name;
                                }
                            }, {
                                targets: 3,
                                render: function(data, type, row) {
                                    return Number(row.loan).toLocaleString();
                                }
                            }, {
                                targets: 4,
                                render: function(data, type, row) {
                                    return Number(row.interest).toLocaleString();
                                }
                            },
                            {
                                targets: 5,
                                render: function(data, type, row) {
                                    return Number(row.loan + row.interest)
                                        .toLocaleString();
                                }
                            }, {
                                targets: 6,
                                render: function(data, type, row) {
                                    return Number(row.installement).toLocaleString();
                                }
                            }, {
                                targets: 7,
                                render: function(data, type, row) {
                                    var total = row.loan + row.interest;
                                    var rounded = Math.round(total / row.installement);
                                    return Number(rounded).toLocaleString();
                                }
                            }, {
                                targets: 8,
                                render: function(data, type, row) {
                                    return Number(row.p_loan + row.p_interest).toLocaleString();
                                }
                            }, {
                                targets: 9,
                                render: function(data, type, row) {
                                    var loan = row.loan + row.interest;
                                    var p_loan = row.p_loan + row.p_interest;
                                    return Number(loan - p_loan).toLocaleString();

                                }
                            }, {
                                targets: 10,
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
                                targets: 11,
                                render: function(data, type, row) {
                                    return row.loan_setting.rate + ' %';
                                }
                            }, {
                                targets: 12,
                                render: function(data, type, row) {
                                    var route =
                                        "{{ route('loan.show', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a href="${route}" class="btn btn-primary btn-sm">View</a>`;
                                }
                            }
                        ],
                        scrollX: true,
                        order: [],
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            }, {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],

                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                },
                                orientation: 'landscape'
                            }, {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                },
                                orientation: 'landscape'
                            }
                        ],
                    });
                }
            });
        });
    </script>
@endsection
