@extends('layouts.app')
@section('title', 'Members')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>VFC STAFF ASSOCIATION MEMBERS</h2>
                    <div>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModel"
                            class="btn btn-outline-primary flex-1 me-2">Add User</a>
                        <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            Add Member
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('user.store') }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="control-label mb-2">Name:</label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" id="name" placeholder="Enter Name" required
                                                    autofocus autocomplete="off">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="control-label mb-2">Username:</label>
                                                <input type="text" name="username" value="{{ old('username') }}"
                                                    class="form-control" placeholder="Enter Username"
                                                    required autocomplete="off">
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="phone" class="control-label mb-2">Phone:</label>
                                                    <input type="text" minlength="10" maxlength="10" name="phone"
                                                        value="{{ old('phone') }}" class="form-control phone"
                                                         placeholder="Enter Phone" required
                                                        autocomplete="off">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="department" class="control-label mb-2">Department:</label>
                                                    <select name="department" class="form-select" required>
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($departments as $item)
                                                            <option {{ $item->id == old('department') ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="savings" class="control-label mb-2">Savings:</label>
                                                    <input type="number" min="0" name="savings"
                                                        value="{{ old('savings') }}" class="form-control phone" placeholder="Enter Savings" required
                                                        autocomplete="off">
                                                    @error('savings')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="role" class="control-label mb-2">Role:</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="" selected disabled>Select</option>
                                                        <option {{ old('role') == '0' ? 'selected' : '' }} value="0">
                                                            ADMINISTRATOR</option>
                                                        <option {{ old('role') == '1' ? 'selected' : '' }} value="1">
                                                            APPROVER</option>
                                                        <option {{ old('role') == '2' ? 'selected' : '' }} value="2">
                                                            MEMBERS</option>
                                                    </select>
                                                    @error('role')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editOffice" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-3">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="exampleModalLabel1">
                        Edit User
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateform" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                            <label for="name" class="control-label">Name:</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                id="name" placeholder="Enter Name" required autofocus autocomplete="off">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="control-label">Username:</label>
                                <input type="text" name="username" value="{{ old('username') }}"
                                    class="form-control" id="username" placeholder="Enter Username" required
                                    autocomplete="off">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="control-label">Phone:</label>
                                <input type="text" minlength="10" maxlength="10" name="phone"
                                    value="{{ old('phone') }}" class="form-control phone" id="phone"
                                    placeholder="Enter Phone" required autocomplete="off">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="department" class="control-label mb-2">Department:</label>
                                <select name="department_id" class="form-select" id="department" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($departments as $item)
                                        <option {{ $item->id == old('department') ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="savings" class="control-label mb-2">Savings:</label>
                                <input type="number" min="0" name="savings" value="{{ old('savings') }}"
                                    class="form-control phone" id="savings" placeholder="Enter Savings" required
                                    autocomplete="off">
                                @error('savings')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="role" class="control-label mb-2">Role:</label>
                                <select name="role" class="form-select" id="role" required>
                                    <option {{ old('role') == '0' ? 'selected' : '' }} value="0">
                                        ADMINISTRATOR</option>
                                    <option {{ old('role') == '1' ? 'selected' : '' }} value="1">
                                        APPROVER</option>
                                    <option {{ old('role') == '2' ? 'selected' : '' }} value="2">
                                        MEMBERS</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="control-label mb-2">Status:</label>
                                <select name="status" class="form-select" id="status" required>
                                    <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                        ACTIVE</option>
                                    <option {{ old('status') == '0' ? 'selected' : '' }} value="0">
                                        INACTIVE</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button class="btn btn-success"> Save Changes </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.editOffice', function() {
            var id = $(this).find('span').data('id');
            var name = $(this).find('span').data('name');
            var phone = $(this).find('span').data('phone');
            var username = $(this).find('span').data('username');
            var role = $(this).find('span').data('role');
            var status = $(this).find('span').data('status');
            var savings = $(this).find('span').data('savings');
            var department = $(this).find('span').data('department');
            // Populate the modal fields with the retrieved data
            $('#editOffice').find('#id').val(id);
            $('#editOffice').find('#name').val(name);
            $('#editOffice').find('#phone').val(phone);
            $('#editOffice').find('#username').val(username);
            $('#editOffice').find('#savings').val(savings);
            $('#editOffice').find('#role').val(role);
            $('#editOffice').find('#status').val(status);
            $('#editOffice').find('#department').val(department);

            var route = "{{ route('user.update', ['id' => ':id']) }}";
            route = route.replace(':id', id);

            $('#updateform').attr('action', route);

        });
    </script>
    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $.ajax({
                url: "{{ route('user.index') }}",
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
                        }, {
                            data: ''
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

                                    return `<a href="" data-bs-toggle="modal" data-bs-target="#editOffice"
                                class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="${row.id}" data-name="${row.name}" data-phone="${row.phone}"
                                data-username="${row.username}" data-savings="${row.savings}" data-role="${row.role}"
                                data-status="${row.status}" data-department="${row.department_id}">Edit</span></a>`;
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
        $(document).ready(function() {
            $(".phone").on("input", function() {
                var value = $(this).val();
                var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
                if (!decimalRegex.test(value)) {
                    $(this).val(value.substring(0, value.length - 1));
                }
            });
        });
    </script>
    <script>
        @if ($errors->any())
            @if (old('id'))
                new bootstrap.Modal(document.getElementById('editOffice'), {
                    keyboard: false
                }).show();
            @else
                new bootstrap.Modal(document.getElementById('addModel'), {
                    keyboard: false
                }).show();
            @endif
        @endif
    </script>
@endsection
