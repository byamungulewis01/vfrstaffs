@extends('layouts.app')
@section('title', 'Dashboard')
@section('body')

    <div class="row mb-3">
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100 border-0 zoom-in bg-primary-subtle shadow">
                <div class="card-body p-4 fw-semibold fs-3 text-primary">
                    <h4 class="fw-semibold text-primary">SAVINGS</h4>
                    <p class="mb-2 fs-8">{{ number_format($savings) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100 border-0 zoom-in bg-danger-subtle shadow">
                <div class="card-body p-4 fw-semibold fs-3 text-danger">
                    <h4 class="fw-semibold text-danger">LOANS</h4>
                    <p class="mb-2 fs-8">{{ number_format($total_loan) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100 border-0 zoom-in bg-info-subtle shadow">
                <div class="card-body p-4 fw-semibold fs-3 text-info">
                    <h4 class="fw-semibold text-info">I&E STETEMENT</h4>
                    <p class="mb-2 fs-8">{{ number_format($total_income) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100 border-0 zoom-in bg-info-warning shadow">
                <div class="card-body p-4 fw-semibold fs-3 text-warning">
                    <h4 class="fw-semibold text-warning">ACCOUNT</h4>
                    <p class="mb-2 fs-8">{{ number_format($total_sva) }}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Income and Expense</h5>
                    <p class="card-subtitle mb-7">Vision Found Rwanda Income and Expense</p>
                    <div class="position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="{{ asset('assets/images/svgs/icon-paypal2.svg') }}" alt=""
                                        class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Income</h6>
                                    <p class="fs-3 mb-0">Total Incomes</p>
                                </div>
                            </div>
                            <h5 class="mb-0 fw-semibold">{{ number_format($total_income) }}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-success-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="{{ asset('assets/images/svgs/icon-wallet.svg') }}" alt=""
                                        class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Interest</h6>
                                    <p class="fs-3 mb-0">Income loan interest</p>
                                </div>
                            </div>
                            <h5 class="mb-0 fw-semibold">{{ number_format($interest) }}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-warning-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="{{ asset('assets/images/svgs/icon-credit-card.svg') }}" alt=""
                                        class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Other</h6>
                                    <p class="fs-3 mb-0">Other incomes</p>
                                </div>
                            </div>
                            <h5 class="mb-0 fw-semibold">{{ number_format($others) }}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-7 pb-1">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-danger-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="{{ asset('assets/images/svgs/icon-pie2.svg') }}" alt=""
                                        class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Expense</h6>
                                    <p class="fs-3 mb-0">Total Expenses</p>
                                </div>
                            </div>
                            <h5 class="mb-0 fw-semibold">{{ number_format($expense) }}</h5>
                        </div>
                    </div>
                    {{-- <button class="btn btn-outline-primary w-100">View all transactions</button> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Loan Summary</h5>
                            <p class="card-subtitle">Vision Found Rwanda Loan Dashboard</p>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fs-5 fw-semibold">
                                    <th scope="col" class="ps-0">Settings</th>
                                    <th scope="col">Laon</th>
                                    <th scope="col">Interest</th>
                                    <th scope="col">Total(L+I)</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <tr>
                                    <td class="ps-0">
                                        <span
                                            class="badge fw-semibold py-1 fs-5 w-85 bg-success-subtle text-success">Loan</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($loan_approval) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($loan_interest_approval) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">
                                            {{ number_format($loan_approval + $loan_interest_approval) }}</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <span class="badge fw-semibold fs-5 py-1 w-85 bg-primary-subtle text-primary">Paid
                                            Loan</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($loan_paid) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($loan_interest_paid) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">
                                            {{ number_format($loan_paid + $loan_interest_paid) }}</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <span class="badge fw-semibold fs-5 py-1 w-85 bg-danger-subtle text-danger">Balance
                                            Loan</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($remain_loan) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">{{ number_format($remain_loan_interest) }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-5 text-dark">
                                            {{ number_format($remain_loan + $remain_loan_interest) }}</p>
                                    </td>
                                </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
