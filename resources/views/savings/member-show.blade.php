@extends('layouts.app')
@section('title', 'Savings')
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

@endsection
@section('body')
    <div class="product-list">
        <div class="card mb-3">
            <div class="card-body p-3">
                <table class="table align-middle text-nowrap mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Member ID</th>
                            <th scope="col">Names</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Monthly Savings</th>
                            <th scope="col">Total Savings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->regnumber }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }} </td>
                            <td>{{ number_format($user->savings) }}</td>
                            <td>
                                @php
                                    $withdraw = \App\Models\SavingMember::where('user_id', $id)
                                        ->where('type', 'withdraw')
                                        ->where('status', 'approved')
                                        ->sum('amount');
                                    $total = $user->total_amount - $withdraw;
                                    $footer_total = $total;
                                @endphp
                                {{ number_format($total) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="card mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Savings</h4>
                        @if (auth()->user()->role == '0')
                        <button class="btn btn-outline-primary flex-1 me-2" data-bs-toggle="modal"
                            data-bs-target="#addModel">Add MST</button>
                        @endif
                        <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            Member Savings Transaction
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('saving.memberSaving', $user->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="amount" class="control-label mb-2">Amount:</label>
                                                <input type="number" min="1" name="amount"
                                                    value="{{ old('amount') }}" class="form-control" id="amount"
                                                    placeholder="Enter Amount" required autofocus autocomplete="off">
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="amount" class="control-label mb-2">Transaction Type:</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="deposit" value="deposit">
                                                    <label class="form-check-label" for="deposit">Deposit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="withdraw" value="withdraw">
                                                    <label class="form-check-label" for="withdraw">Withdraw</label>
                                                </div>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="comment" class="control-label mb-2">Comment:</label>
                                                <textarea name="comment" class="form-control" rows="2" placeholder="Text Here..."></textarea>
                                                @error('comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                        @if ($saving->type == 'deposit')
                                            Deposit
                                        @else
                                            Withdraw
                                        @endif
                                    </td>
                                    <td>{{ $saving->comment }}</td>
                                    <td>{{ number_format($saving->amount) }}</td>
                                    <td>
                                        {{ number_format($total) }}
                                        @if ($saving->type == 'deposit')
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
    @include('layouts.datatable_js')

    <script>
        $(function() {
            $('#datatable').DataTable({
                scrollX: true,
                order: [],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            });
        });
    </script>
@endsection
