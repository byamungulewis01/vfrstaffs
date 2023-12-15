@extends('layouts.app')
@section('title', 'VSA Account')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('dist/datepicker/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h2 class="w-50">VSA ACCOUNT  </h2>
                    <div class="example">
                        <form action="" method="get">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" autocomplete="off" class="form-control" value="{{ $_start ?: now()->format('m/d/Y') }}" name="start" />

                                <span class="input-group-text bg-primary b-0 text-white">TO</span>

                                <input type="text" autocomplete="off" class="form-control" value="{{ $_end ?: now()->format('m/d/Y') }}" name="end" />
                                <button class="btn btn-primary ">Search</button>

                            </div>
                        </form>
                    </div>
                </div>
                <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th>N0</th>
                            <th>DATE</th>
                            <th>COMMENT</th>
                            <th>SOURCE</th>
                            <th>AMOUNT</th>
                            <th>BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vsaAccounts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->comment }}</td>
                                <td>{{ $item->source }}</td>
                                <td>{{ number_format($item->amount) }}</td>
                                <td>
                                    {{ number_format($total_sva) }}
                                    @php
                                        if ($item->type == 'deposit') {
                                            $total_sva -= $item->amount;
                                        } else {
                                            $total_sva += $item->amount;
                                        }

                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dist/datepicker/moment.js') }}"></script>
    <script src="{{ asset('dist/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        jQuery("#date-range").datepicker({
            toggleActive: true,
            endDate: '0d',
        });
    </script>
    <!-- ---------------------------------------------- -->
    @include('layouts.datatable_js')
    <script>
        $('#datatable').DataTable({
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    </script>

@endsection
