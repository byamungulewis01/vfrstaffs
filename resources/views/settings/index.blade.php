@extends('layouts.app')
@section('title', 'Settings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-9">
                        <h5 class="mb-0">List of Departments</h5>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Ministry"
                            class="btn btn-primary btn-sm">Add New</a>
                        <div class="modal fade" id="Ministry" tabindex="-1" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content p-3">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            New Department
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('setting.storeDepartment') }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="control-label mb-2">Name:</label>
                                                <input type="text" name="name" class="form-control text-capitalize"
                                                    value="{{ old('name') }}" autocomplete="off" autofocus="on"
                                                    placeholder="Department Name">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-danger text-danger font-medium"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-success"> Submit </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->
                    </div>
                    <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="scope">#</th>
                                <th scope="col">Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $item)
                                <tr>
                                    <th>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</th>
                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td class="d-flex justify-content-center gap-2">
                                        <a data-bs-toggle="modal" data-bs-target="#editDepartment{{ $item->id }}"
                                            class="btn btn-sm btn-primary" href="#"><i
                                                class="fs-4 ti ti-edit"></i>Edit</a>
                                        <a data-bs-toggle="modal" data-bs-target="#deleteDepartment{{ $item->id }}"
                                            class="btn btn-sm btn-danger" href="#"><i
                                                class="fs-4 ti ti-trash"></i>Delete</a>

                                        <div class="modal fade" id="deleteDepartment{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="vertical-center-modal" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content modal-filled bg-light-danger">
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('setting.destroyDepartment', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="text-center text-danger">
                                                                <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                                <h4 class="mt-2">Are you sure to delete?</h4>
                                                                <p class="mt-3">
                                                                    Deletion will permanently remove
                                                                    from your list.
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
                                        <div class="modal fade" id="editDepartment{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content p-3">
                                                    <div class="modal-header d-flex align-items-center">
                                                        <h4 class="modal-title" id="exampleModalLabel1">
                                                            Edit Department
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('setting.updateDepartment', $item->id) }}"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name"
                                                                    class="control-label mb-2">Name:</label>
                                                                <input type="text" name="name"
                                                                    class="form-control text-capitalize"
                                                                    value="{{ $item->name }}">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-light-danger text-danger font-medium"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button class="btn btn-success"> Save </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-9">
                        <h5 class="mb-0">Loan Settings</h5>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#LoanSettingsModal"
                            class="btn btn-primary btn-sm">Add New</a>
                        <div class="modal fade" id="LoanSettingsModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content p-3">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            New Loan type
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('setting.storeLoanSetting') }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="control-label mb-2">Loan Type Name:</label>
                                                <input type="text" name="name" class="form-control text-capitalize"
                                                    value="{{ old('name') }}" autocomplete="off" autofocus="on"
                                                    placeholder="Loan Type Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="rate" class="control-label mb-2">Loan interest
                                                    rate:</label>
                                                <input type="number" name="rate" class="form-control"
                                                    value="{{ old('rate') }}" autocomplete="off"
                                                    placeholder="Loan interest rate" min="1" max="100">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-danger text-danger font-medium"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-success"> Submit </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->
                    </div>
                    <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="scope">Laon ID</th>
                                <th scope="col">Laon Type Name</th>
                                <th scope="col">Rate</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loanSettings as $item)
                                <tr>
                                    <th>{{ $item->loan_id }}</th>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->rate }} %
                                    </td>

                                    <td class="d-flex justify-content-center gap-2">
                                        <a data-bs-toggle="modal" data-bs-target="#editLoanSetting{{ $item->id }}"
                                            class="btn btn-sm btn-primary" href="#"><i
                                                class="fs-4 ti ti-edit"></i>Edit</a>

                                        <div class="modal fade" id="editLoanSetting{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content p-3">
                                                    <div class="modal-header d-flex align-items-center">
                                                        <h4 class="modal-title" id="exampleModalLabel1">
                                                            Edit Loan Setting
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('setting.updateLoanSetting', $item->id) }}"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name" class="control-label mb-2">Loan Type
                                                                    Name:</label>
                                                                <input type="text" name="name"
                                                                    class="form-control text-capitalize"
                                                                    value="{{ $item->name }}" autocomplete="off"
                                                                    autofocus="on" placeholder="Loan Type Name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rate" class="control-label mb-2">Loan
                                                                    interest
                                                                    rate:</label>
                                                                <input type="number" name="rate" class="form-control"
                                                                    value="{{ $item->rate }}" autocomplete="off"
                                                                    placeholder="Loan interest rate" min="1"
                                                                    max="100">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-light-danger text-danger font-medium"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button class="btn btn-success"> Save </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                </tr>
                            @endforeach
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
            $(".datatable").DataTable({
                scrollX: true,
                lengthMenu: [5, 10, 25, 50], // Define available page lengths
                pageLength: 5, // Set default page length to 5

            });
        });
    </script>
@endsection
