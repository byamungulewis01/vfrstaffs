@extends('layouts.app')
@section('title', 'All Members')
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
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="activeModel" tabindex="-1" aria-labelledby="vertical-center-modal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content modal-filled bg-light-primary">
                <div class="modal-body p-4">
                    <form id="activateUser" method="post">
                        @csrf
                        @method('PUT')
                        <div class="text-center text-primary">
                            <h4 class="mt-2 text-primary">You Are about to Activate</h4>
                            <p class="mt-3">
                                Please Ensure that you have read carefully the List of Terms and Conditions
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
    <div class="modal fade" id="disactiveModel" tabindex="-1" aria-labelledby="vertical-center-modal"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <form id="disactivateUser" method="post">
                        @csrf
                        @method('PUT')
                        <div class="text-center text-danger">
                            <h4 class="mt-2 text-danger">You Are about to Disactivate</h4>
                            <p class="mt-3">
                                Please Ensure that you have read carefully the List of Terms and Conditions
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


@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $.ajax({
                url: "{{ route('user.all') }}",
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
                            }, {
                                targets: 7,
                                render: function(data, type, row, meta) {

                                    if (row.status == '0') {

                                        return `<a href="" data-bs-toggle="modal" data-bs-target="#activeModel"
                                    class="btn btn-sm btn-outline-primary activeUser">
                                    <span data-id="${row.id}">Active</span></a>`;
                                    } else {
                                        return `<a href="" data-bs-toggle="modal" data-bs-target="#disactiveModel"
                                    class="btn btn-sm btn-outline-danger disactiveUser">
                                    <span data-id="${row.id}">Disactive</span></a>`;

                                    }

                                }
                            }
                        ],

                        scrollX: true,
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.activeUser', function() {
            var id = $(this).find('span').data('id');
            var route = "{{ route('user.activate', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#activateUser').attr('action', route);

        });
    </script>
    <script>
        $(document).on('click', '.disactiveUser', function() {
            var id = $(this).find('span').data('id');
            var route = "{{ route('user.disactivate', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#disactivateUser').attr('action', route);

        });
    </script>
@endsection
