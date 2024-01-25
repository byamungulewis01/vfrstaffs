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
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-3">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="exampleModalLabel1">
                        Member Savings Transaction
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAction" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="control-label mb-2">Name:</label>
                            <input type="text" disabled id="name" value="{{ old('name') }}"
                                class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            {{-- <label for="amount" class="control-label mb-2">Reg Number:</label> --}}
                            <input type="hidden" name="regnumber" id="regnumber" value="{{ old('regnumber') }}"
                                class="form-control" id="regnumber" autofocus placeholder="Enter RegNumber" required
                                autocomplete="off">
                            @error('regnumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="control-label mb-2">Amount:</label>
                            <input type="number" min="1" name="amount" value="{{ old('amount') }}"
                                class="form-control" id="amount" placeholder="Enter Amount" required autocomplete="off">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="loan_type" class="control-label mb-2">Loan Type:</label>
                                <select name="loan_type" class="form-select" id="loan_type">
                                    <option value="">Select Loan Type</option>
                                    @foreach ($loanTypes as $loanType)
                                        <option value="{{ $loanType->id }}">{{ $loanType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('loan_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="installement" class="control-label mb-2">Payment
                                    Installement:</label>
                                <input type="number" min="1" max="20" name="installement"
                                    value="{{ old('installement') }}" class="form-control" id="installement"
                                    placeholder="Number Of payment Installement" required autocomplete="off">
                                @error('installement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="control-label mb-2">Comment:</label>
                            <textarea name="comment" class="form-control" rows="4" placeholder="Text Here..."></textarea>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button class="btn btn-success"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

@endsection
@section('script')
    <script>
        $(document).on('click', '.addModel', function() {
            var id = $(this).find('span').data('id');
            var regnumber = $(this).find('span').data('regnumber');
            var name = $(this).find('span').data('name');

            // Populate the modal fields with the retrieved data
            $('#addModel').find('#id').val(id);
            $('#addModel').find('#name').val(name);
            $('#addModel').find('#regnumber').val(regnumber);

            var route = "{{ route('loan.store') }}";
            $('#formAction').attr('action', route);

        });
    </script>
    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $.ajax({
                url: "{{ route('api.loanMembers') }}",
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
                                targets: 5,
                                render: function(data, type, row, meta) {

                                    return `<a href="" data-bs-toggle="modal" data-bs-target="#addModel"
                                class="btn btn-sm btn-outline-primary addModel">
                                <span data-id="${row.id}" data-regnumber="${row.regnumber}" data-name="${row.name}">Loan Request</span></a>`;
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
