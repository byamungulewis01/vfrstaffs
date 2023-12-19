@extends('layouts.app')
@section('title', 'Members Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>VFC STAFF MEMBERS SAVINGS</h2>

                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Monthly Savings</th>
                            <th scope="col">Total Savings</th>
                            <th scope="col">Action</th>
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
    @include('layouts.datatable_js')

    <script>
        $(function() {
            $.ajax({
                url: "{{ route('saving.members') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('#datatable').DataTable({

                        data: data,

                        columnDefs: [{
                            targets: 0,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        }, {
                            targets: 1,
                            render: function(data, type, row, meta) {
                                return row.regnumber;
                            }
                        }, {
                            targets: 2,
                            render: function(data, type, row, meta) {
                                return row.name;
                            }
                        }, {
                            targets: 3,
                            render: function(data, type, row, meta) {
                                return row.phone;
                            }
                        }, {
                            targets: 4,
                            render: function(data, type, row) {
                                return Number(row.savings).toLocaleString();
                            }
                        }, {
                            targets: 5,
                            render: function(data, type, row, meta) {
                                var difference = row.total_amount - row
                                    .total_withdrawn_amount;
                                return Number(difference).toLocaleString();
                            }
                        }, {
                            targets: 6,
                            render: function(data, type, row, meta) {
                                var route =
                                    "{{ route('saving.showMember', ['id' => ':id']) }}";
                                route = route.replace(':id', row.id);
                                return `<a href=${route} class="btn btn-primary btn-sm omit">MS View</a>`;
                            }
                        }, ],
                        scrollX: true,
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            }, {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            }, {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            }
                        ],

                    });
                }
            });
        });
    </script>

@endsection
