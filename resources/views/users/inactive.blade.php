@extends('layouts.app')
@section('title', 'Inactive Members')
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
                            @if (auth()->user()->role == '0')
                            <th scope="col"></th>
                            @endif
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

@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $.ajax({
                url: "{{ route('user.inactive') }}",
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
                            @if (auth()->user()->role == '0')
                             {
                                targets: 7,
                                render: function(data, type, row, meta) {

                                    return `<a href="" data-bs-toggle="modal" data-bs-target="#activeModel"
                                class="btn btn-sm btn-outline-primary activeUser">
                                <span data-id="${row.id}">Active</span></a>`;
                                }
                            }
                            @endif
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
@endsection
