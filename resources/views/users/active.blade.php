@extends('layouts.app')
@section('title', 'Active Members')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>VFC STAFF ASSOCIATION MEMBERS</h2>

                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Monthly Savings</th>
                            <th scope="col">Date</th>
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
                url: "{{ route('user.active') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#datatable').DataTable({

                        data: data,
                        columns: [{
                            data: ''
                        }, {
                            data: 'regnumber'
                        }, {
                            data: 'name'
                        }, {
                            data: 'phone'
                        }, {
                            data: 'department_id'
                        }, {
                            data: 'savings'
                        }, {
                            data: 'created_at'
                        }, ],
                        columnDefs: [

                            {
                                targets: 0,
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, {
                                targets: 4,
                                render: function(data, type, row, meta) {
                                    return '<span>' + row.department.name + '</span>';
                                }
                            }, {
                                targets: 6,
                                render: function(data, type, row, meta) {
                                    const date = new Date(row.created_at);
                                    const options = {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    };
                                    const formattedDate = new Intl.DateTimeFormat(
                                        'en-US', options).format(date);
                                    return '<span>' + formattedDate + '</span>';
                                }
                            },
                        ],

                        scrollX: true,
                    });
                }
            });
        });
    </script>
@endsection
