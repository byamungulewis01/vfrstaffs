@extends('layouts.app')
@section('title', 'Closed Loans')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2>CLOSED LOANS MANAGEMENT</h2>
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
                            <th scope="col">Payed</th>
                            <th scope="col">Remain</th>
                            <th scope="col">Date</th>
                            <th scope="col">ML View</th>
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
                url: "{{ route('loan.loan_closed') }}",
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
                            },  {
                                targets: 6,
                                render: function(data, type, row) {
                                    var loanPays = row.loan_pays;
                                    var sumOfAmounts = loanPays.reduce(function(
                                        accumulator, currentValue) {
                                        return accumulator + (currentValue
                                        .amount + currentValue
                                        .interest);
                                    }, 0);
                                    return sumOfAmounts;
                                }
                            }, {
                                targets: 7,
                                render: function(data, type, row) {
                                    var total = row.loan + row.interest;
                                    var loanPays = row.loan_pays;

                                    var sumOfAmounts = loanPays.reduce(function(
                                        accumulator, currentValue) {
                                        return accumulator + (currentValue
                                        .amount + currentValue
                                        .interest);
                                    }, 0);
                                    return total-sumOfAmounts;

                                }
                            }, {
                                targets: 8,
                                render: function(data, type, row) {
                                    const originalDate = new Date(row.created_at);

                                    // Extract the components of the date
                                    const year = originalDate.getFullYear();
                                    const month = String(originalDate.getMonth() + 1)
                                        .padStart(2,
                                        '0'); // Months are zero-based, so add 1
                                    const day = String(originalDate.getDate()).padStart(
                                        2, '0');
                                    const formattedDate = `${year}/${month}/${day}`;
                                    return formattedDate;
                                }
                            },  {
                                targets: 9,
                                render: function(data, type, row) {
                                    var route =
                                        "{{ route('loan.show', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                    return `<a href="${route}" class="btn btn-primary btn-sm">View</a>`;
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
@endsection
