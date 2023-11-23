@extends('layouts.app')
@section('title', 'Savings Requests')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>SAVINGS MANAGEMENT</h2>
                    @if (auth()->user()->role == '0')
                        <div>
                            <a href="{{ route('saving.create') }}" class="btn btn-outline-primary flex-1 me-2">Add All
                                Savings</a>
                        </div>
                    @endif
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Saving Type</th>
                            <th scope="col">Year</th>
                            <th scope="col">Date</th>
                            <th scope="col">User</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Savings</th>
                            <th scope="col">Members</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="approvalModel" tabindex="-1"
        aria-labelledby="vertical-center-modal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content modal-filled bg-light-primary">
                <div class="modal-body p-4">
                    <form id="approvalForm" method="post">
                        @csrf
                        @method('PUT')
                        <div class="text-center text-primary">
                            <h4 class="mt-2 text-primary">You Are about to Approve</h4>
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
    <div class="modal fade" id="rejectModel" tabindex="-1"
        aria-labelledby="vertical-center-modal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <form id="rejectForm" method="post">
                        @csrf
                        @method('PUT')
                        <div class="text-center text-danger">
                            <h4 class="mt-2 text-danger">Are you Sure Reject?</h4>
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
                url: "{{ route('saving.requests') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#datatable').DataTable({
                        data: data,
                        columns: [{
                            data: ''
                        }, {
                            data: 'created_at'
                        }, {
                            data: 'created_at'
                        }, {
                            data: 'created_at'
                        }, {
                            data: ''
                        }, {
                            data: 'comment'
                        }, {
                            data: 'amount'
                        }, ],
                        columnDefs: [

                            {
                                targets: 0,
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, {
                                targets: 1,
                                render: function(data, type, row) {
                                    const date = new Date(row.created_at);
                                    const options = {
                                        month: 'long'
                                    };
                                    const formattedDate = new Intl.DateTimeFormat(
                                        'en-US', options).format(date);
                                    if (row.saving_by === 'members') {
                                        return '<span class="text-primary">' +
                                            formattedDate +
                                            ' <span class="text-dark">Savings</span> </span>';
                                    } else {
                                        return 'MST';
                                    }
                                }
                            }, {
                                targets: 2,
                                render: function(data, type, row) {
                                    const date = new Date(row.created_at);
                                    const options = {
                                        year: 'numeric'
                                    };
                                    const formattedDate = new Intl.DateTimeFormat(
                                        'en-US', options).format(date);
                                    return '<span>' + formattedDate + '</span>';
                                }
                            }, {
                                targets: 3,
                                render: function(data, type, row) {
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
                                targets: 4,
                                render: function(data, type, row) {
                                    return '<span>' + row.user.name + '</span>';
                                }
                            }, {
                                targets: 7,
                                render: function(data, type, row) {
                                    var route =
                                        "{{ route('saving.requestShow', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a href="${route}"><i class="text-primary ti ti-eye"></i>   View</a>`;
                                }
                            }, {
                                targets: 8,
                                render: function(data, type, row) {
                                    return `<button class="btn btn-primary btn-sm approvalModel" data-bs-toggle="modal" data-bs-target="#approvalModel"><span data-id="${row.id}">Approve</span></button>
                                            <button class="btn btn-danger btn-sm rejectModel" data-bs-toggle="modal" data-bs-target="#rejectModel"><span data-id="${row.id}">Reject</span></button>`;
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
    <script>
        $(document).on('click', '.approvalModel', function() {
            var id = $(this).find('span').data('id');
            var route = "{{ route('saving.approve', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#approvalForm').attr('action', route);

        });
    </script>
    <script>
        $(document).on('click', '.rejectModel', function() {
            var id = $(this).find('span').data('id');
            var route = "{{ route('saving.reject', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#rejectForm').attr('action', route);

        });
    </script>
@endsection
