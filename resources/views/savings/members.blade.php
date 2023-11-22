@extends('layouts.app')
@section('title', 'Members Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
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
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
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
                        columns: [{
                            data: ''
                        }, {
                            data: 'regnumber'
                        }, {
                            data: 'name'
                        }, {
                            data: 'phone'
                        }, {
                            data: 'savings'
                        }, {
                            data: 'total_amount'
                        }, ],
                        columnDefs: [

                            {
                                targets: 0,
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, {
                                targets: 6,
                                render: function(data, type, row, meta) {
                                    var route ="{{ route('saving.showMember', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a href=${route} class="btn btn-primary btn-sm">MS View</a>`;
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
