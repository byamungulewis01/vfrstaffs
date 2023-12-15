@extends('layouts.app')
@section('title', 'Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>ACTIVE LOANS MANAGEMENT</h2>

                    <button data-bs-toggle="modal" data-bs-target="#approvalAllModel" class="btn btn-outline-primary flex-1 me-2">Approve All</button>

                    <div class="modal fade" id="approvalAllModel" tabindex="-1" aria-labelledby="vertical-center-modal"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content modal-filled bg-light-primary">
                                <div class="modal-body p-4">
                                    <form action="{{ route('loan.approve_all') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-center text-primary">
                                            <h4 class="mt-2 text-primary">Are you sure to approve all ?</h4>
                                            <p class="mt-3">
                                                Please Ensure that you have read carefully the List of Terms and
                                                Conditions
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
                            <th scope="col">Loan Type</th>
                            <th scope="col"></th>
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
                url: "{{ route('loan.requests') }}",
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
                                    return row.loan;
                                }
                            }, {
                                targets: 4,
                                render: function(data, type, row) {
                                    return row.interest;
                                }
                            },
                            {
                                targets: 5,
                                render: function(data, type, row) {
                                    return row.loan + row.interest;
                                }
                            }, {
                                targets: 6,
                                render: function(data, type, row) {
                                    return row.installement;
                                }
                            }, {
                                targets: 7,
                                render: function(data, type, row) {
                                    return row.loan_setting.name;
                                }
                            }, {
                                targets: 8,
                                render: function(data, type, row) {
                                    return `<button class="btn btn-primary btn-sm approvalModel" data-bs-toggle="modal" data-bs-target="#approvalModel"><span data-id="${row.id}">Approve</span></button>
                                            <button class="btn btn-danger btn-sm rejectModel" data-bs-toggle="modal" data-bs-target="#rejectModel"><span data-id="${row.id}">Reject</span></button>`;
                                }
                            }
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
            var route = "{{ route('loan.approve', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#approvalForm').attr('action', route);

        });
    </script>
    <script>
        $(document).on('click', '.rejectModel', function() {
            var id = $(this).find('span').data('id');
            var route = "{{ route('loan.reject', ['id' => ':id']) }}";
            route = route.replace(':id', id);
            $('#rejectForm').attr('action', route);

        });
    </script>
@endsection
