<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpence;
use App\Models\Loan;
use App\Models\LoanPay;
use App\Models\SavingMember;
use App\Models\VsaAccount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $save_deposit = (int) SavingMember::where('type', 'deposit')->where('status', 'approved')->sum('amount');
        $save_withdraw = (int) SavingMember::where('type', 'withdraw')->where('status', 'approved')->sum('amount');
        $savings = $save_deposit - $save_withdraw;

        $loan_approval = (int) Loan::where('status', 'approved')->sum('loan');
        $loan_paid =  (int) Loan::where('status', 'approved')->sum('p_loan');

        $loan_interest_approval = (int) Loan::where('status', 'approved')->sum('interest');
        $loan_interest_paid = (int) Loan::where('status', 'approved')->sum('p_interest');
        $remain_loan = $loan_approval - $loan_paid;
        $remain_loan_interest = (int) Loan::where('status', 'approved')->sum('remain_interest');

        $total_loan = $remain_loan + $remain_loan_interest;


        $income = (int) IncomeExpence::where('type', 'income')->where('status', 'approved')->sum('amount');
        $expense = (int) IncomeExpence::where('type', 'expense')->where('status', 'approved')->sum('amount');
        $interest = (int) IncomeExpence::where('type', 'income')->where('source', 'interest')->where('status', 'approved')->sum('amount');
        $others = (int) IncomeExpence::where('type', 'income')->where('source', 'other')->where('status', 'approved')->sum('amount');
        $total_income = $income - $expense;

        $total_sva = $savings - $loan_approval + $total_income + $loan_paid;
        return view('dashboard.index', compact('savings', 'loan_approval', 'loan_interest_approval', 'total_loan',
            'total_income', 'total_sva', 'interest', 'others', 'expense', 'loan_paid',
            'loan_interest_paid', 'remain_loan', 'remain_loan_interest'));
    }

    public function vsa_account(Request $request)
    {
        $_start = $request->start;
        $_end = $request->end;

        $start = \Carbon\Carbon::parse($request->start)->format('Y-m-d');
        $end = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

        $save_deposit = (int) SavingMember::where('type', 'deposit')->where('status', 'approved')->sum('amount');
        $save_withdraw = (int) SavingMember::where('type', 'withdraw')->where('status', 'approved')->sum('amount');
        $savings = $save_deposit - $save_withdraw;

        $loan_approval = (int) Loan::where('status', 'approved')->sum('loan');

        $income = (int) IncomeExpence::where('type', 'income')->where('status', 'approved')->sum('amount');
        $expense = (int) IncomeExpence::where('type', 'expense')->where('status', 'approved')->sum('amount');
        $total_income = $income - $expense;

        $loan_paid =  (int) Loan::where('status', 'approved')->sum('p_loan');


        $total_sva = $savings - $loan_approval + $total_income + $loan_paid;
        $vsaAccounts = VsaAccount::query()
            ->when($request->has('start') && $request->has('end'), function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })->orderByDesc('id')->get();
        return view('reports.index', compact('vsaAccounts', 'total_sva', '_start', '_end'));
    }
}
