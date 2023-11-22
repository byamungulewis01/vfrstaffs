@extends('layouts.app')
@section('title', 'Create Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card w-100 position-relative overflow-hidden mb-0">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Create Monthly Saving</h5>
                <p class="card-subtitle mb-4">Crediting Staff Saving Of Month <span
                        class="text-warning">{{ date('F-Y') }}</span></p>
                <form action="{{ route('saving.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-4">
                                <div style="display: none;" id="totalSavings">Total Savings: {{ $users->sum('savings') }}</div>
                                <label for="exampleInputtext" class="form-label fw-semibold">Total Monthly Savings</label>
                                <input type="text" name="amount" class="form-control" readonly id="exampleInputtext" value="{{ $users->sum('savings') }}">
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <label for="exampleInputtext2" class="form-label fw-semibold">Comment</label>
                                <input type="text" required name="comment" class="form-control" id="exampleInputtext2"
                                    placeholder="Saving Comments .....">
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="">
                                <label for="exampleInputtext4" class="form-label fw-semibold">Member List</label>
                                <table class="table align-middle text-nowrap mb-0" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Member ID</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Monthly Savings</th>
                                            <th scope="col">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $user->regnumber }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->department->name }}</td>
                                                <td>
                                                    {{ $user->savings }}
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="members[]" type="checkbox" checked
                                                            value="{{ $user->id }},{{ $user->savings }}" data-savings="{{ $user->savings }}"
                                                            id="check" onchange="updateTotalSavings(this)">

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                <button class="btn btn-primary">Save</button>
                                <a href="" class="btn bg-danger-subtle text-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $('#datatable').DataTable();
    </script>

    <script>
        // Function to update total savings based on checkbox changes
        function updateTotalSavings(checkbox) {
            // Get the current total savings
            var totalSavings = parseFloat(document.getElementById('totalSavings').innerText.split(':')[1].trim());

            // Get the savings value from the data attribute
            var savingsValue = parseFloat(checkbox.getAttribute('data-savings'));

            // Update total savings based on checkbox state
            if (checkbox.checked) {
                totalSavings += savingsValue;
            } else {
                totalSavings -= savingsValue;
            }

            // Update the total savings display
            document.getElementById('totalSavings').innerText = 'Total Savings: ' + totalSavings.toFixed(2);
            $('#exampleInputtext').val(totalSavings);
        }
    </script>

@endsection
