@extends('layouts.app')
@section('title', 'Member Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@php
$withdraw = \App\Models\SavingMember::where('user_id', auth()->user()->id)
    ->where('type', 'withdraw')
    ->sum('amount');
$total = $user->total_amount - $withdraw;
$footer_total = $total;
@endphp
@section('body')
    <div class="product-list">
        <div class="row">
            <div class="card mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Savings</h4>
                    </div>
                    <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($savings as $saving)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $saving->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($saving->_saving->type == 'deposit')
                                            Deposit
                                        @else
                                            Withdraw
                                        @endif
                                    </td>
                                    <td>{{ $saving->_saving->comment }}</td>
                                    <td>{{ number_format($saving->amount) }}</td>
                                    <td>
                                        {{ number_format($total) }}
                                        @if ($saving->_saving->type == 'deposit')
                                            @php $total -= $saving->amount  @endphp
                                        @else
                                            @php $total += $saving->amount  @endphp
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="2">Total Saving</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">{{ number_format($footer_total) }}</th>
                                <th scope="col"></th>
                            </tr>
                            </tr>
                        </tfoot>
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
            $('#datatable').DataTable();
        });
    </script>
@endsection
