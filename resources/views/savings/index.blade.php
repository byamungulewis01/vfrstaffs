@extends('layouts.app')
@section('title', 'Savings')
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
                            <th scope="col">Status</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Savings</th>
                            <th scope="col">Members</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
                <div id="loadingIndicator" style="display: none;" class="py-6">
                    <div class="card-body">
                        <div class="spinner-border spinner-border-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
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
            $('#loadingIndicator').show();
            $.ajax({
                url: "{{ route('saving.index') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#loadingIndicator').hide();
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
                            data: 'status'
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
                                    if (row.saving_by == null) {
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
                                targets: 5,
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
                                targets: 8,
                                render: function(data, type, row) {
                                    var route =
                                        "{{ route('saving.show', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a class="btn btn-sm btn-primary" href="${route}"> View</a>`;
                                }
                            },
                        ],
                        scrollX: true,
                        order: [],

                    });
                },
                error: function() {
                    // Hide loading indicator on error (if needed)
                    $('#loadingIndicator').hide();

                    // Handle error if necessary
                    console.error('Error fetching data');
                }
            });
        });
    </script>
@endsection
