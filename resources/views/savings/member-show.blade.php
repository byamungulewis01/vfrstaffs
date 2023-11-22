@extends('layouts.app')
@section('title', 'Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card mb-3">
            <div class="card-body p-3">
                <table class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Monthly Savings</th>
                            <th scope="col">Total Savings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->regnumber }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }} </td>
                            <td>{{ $user->savings }}</td>
                            <td>{{ $user->total_amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="row">
        <div class="card mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">All Savings</h4>
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Monthly Savings</th>
                        </tr>
                    </thead>
                    <tbody>

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
            var id = "{{ $user->id }}";
            var route ="{{ route('saving.show', ['id' => ':id']) }}";
             route = route.replace(':id', id);
            $.ajax({
                url: route,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('#datatable').DataTable({

                        data: data,
                        columns: [{
                            data: ''
                        }, {
                            data: ''
                        }, {
                            data: ''
                        }, {
                            data: ''
                        }, {
                            data: 'amount'
                        },],
                        columnDefs: [

                            {
                                targets: 0,
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, {
                                targets: 1,
                                render: function(data, type, row) {
                                    return '<span>' + row.user.regnumber + '</span>';
                                }
                            },  {
                                targets: 2,
                                render: function(data, type, row) {
                                    return '<span>' + row.user.name + '</span>';
                                }
                            },{
                                targets: 3,
                                render: function(data, type, row) {
                                    return '<span>' + row.user.phone + '</span>';
                                }
                            }
                        ],

                        scrollX: true,
                    });
                }
            });
        });
    </script>
@endsection
