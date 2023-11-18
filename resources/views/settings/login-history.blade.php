@extends('layouts.app')
@section('title', 'Settings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h5 class="mb-0">LOGIN REPORTS</h5>
            </div>
            <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="scope">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">IP Adress</th>
                        <th scope="col">Login Date</th>
                        <th scope="col">Logout Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->user_name }}</td>
                            <td> {{ $log->ip_address }}</td>
                            </td>
                            <td>{{ $log->login_at }}</td>
                            <td>{{ $log->logout_at }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
@section('script')

    <!-- ---------------------------------------------- -->
    <script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function() {
            $(".datatable").DataTable();
        });
    </script>
@endsection
