<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPay;
use App\Models\VsaAccount;
use App\Models\SavingMember;
use Illuminate\Http\Request;
use App\Models\IncomeExpence;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $save_deposit = (int) SavingMember::where('type', 'deposit')->where('status', 'approved')->sum('amount');
        $save_withdraw = (int) SavingMember::where('type', 'withdraw')->where('status', 'approved')->sum('amount');
        $savings = $save_deposit - $save_withdraw;

        $loan_approval = (int) Loan::where('status', 'approved')->sum('loan');
        $loan_paid = (int) Loan::where('status', 'approved')->sum('p_loan');

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
        return view(
            'dashboard.index',
            compact(
                'savings',
                'loan_approval',
                'loan_interest_approval',
                'total_loan',
                'total_income',
                'total_sva',
                'interest',
                'others',
                'expense',
                'loan_paid',
                'loan_interest_paid',
                'remain_loan',
                'remain_loan_interest'
            )
        );
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

        $loan_paid = (int) Loan::where('status', 'approved')->sum('p_loan');


        $total_sva = $savings - $loan_approval + $total_income + $loan_paid;
        $vsaAccounts = VsaAccount::query()
            ->when($request->has('start') && $request->has('end'), function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })->orderByDesc('id')->get();
        return view('reports.index', compact('vsaAccounts', 'total_sva', '_start', '_end'));
    }
    public function journal_report(Request $request)
    {
        $_start = $request->start;
        $_end = $request->end;

        $start = \Carbon\Carbon::parse($request->start)->format('Y-m-d');
        $end = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

        // $journal_reports = VsaAccount::query()
        //     ->when($request->has('start') && $request->has('end'), function ($query) use ($start, $end) {
        //         $query->whereBetween('created_at', [$start, $end]);
        //     })->orderByDesc('id')->get();



        $journal_reports = VsaAccount::leftJoin('saving_members', function ($join) {
            $join->on('vsa_accounts.tranking', '=', 'saving_members.id')
                ->where('vsa_accounts.source', '=', 'saving');
        })
            ->leftJoin('income_expences', function ($join) {
                $join->on('vsa_accounts.tranking', '=', 'income_expences.id')
                    ->where('vsa_accounts.source', '=', 'other');
            })
            ->leftJoin('loans', function ($join) {
                $join->on('vsa_accounts.tranking', '=', 'loans.id')
                    ->where('vsa_accounts.source', '=', 'loan')
                    ->where('vsa_accounts.isLoan', '=', true);
            })
            ->leftJoin('loan_pays', function ($join) {
                $join->on('vsa_accounts.tranking', '=', 'loan_pays.id')
                    ->where('vsa_accounts.source', '!=', 'saving')
                    ->where('vsa_accounts.source', '!=', 'other')
                    ->where('vsa_accounts.isLoan', '=', false);
            })
            ->leftJoin('users as saving_users', 'saving_members.saving_id', '=', 'saving_users.id')
            ->leftJoin('users as income_expences_users', 'income_expences.user_id', '=', 'income_expences_users.id')
            ->leftJoin('users as loan_users', 'loans.posted_by', '=', 'loan_users.id')
            ->leftJoin('users as loan_pay_users', 'loan_pays.posted_by', '=', 'loan_pay_users.id')
            ->leftJoin('users as approve_users', 'saving_members.approved_by', '=', 'approve_users.id')
            ->leftJoin('users as income_expences_approval_users', 'income_expences.user_id', '=', 'income_expences_approval_users.id')
            ->leftJoin('users as loan_approval_users', 'loans.approved_by', '=', 'loan_approval_users.id')
            ->leftJoin('users as loan_pay_approval_users', 'loan_pays.approved_by', '=', 'loan_pay_approval_users.id')
            ->leftJoin('users as saving_member', 'saving_members.user_id', '=', 'saving_member.id')
            ->leftJoin('users as loan_member', 'loans.user_id', '=', 'loan_member.id')
            ->leftJoin('users as loan_pay_member', 'loan_pays.user_id', '=', 'loan_pay_member.id')
            ->select(
                'vsa_accounts.*',
                DB::raw('CASE
        WHEN vsa_accounts.source = "saving" THEN COALESCE(saving_users.name, "Unknown Posted By")
        WHEN vsa_accounts.source = "other" THEN COALESCE(income_expences_users.name, "Unknown Posted By")
        WHEN vsa_accounts.source = "loan" AND vsa_accounts.isLoan = true THEN COALESCE(loan_users.name, "Unknown Posted By")
        ELSE COALESCE(loan_pay_users.name, "Unknown Posted By") END as posted_by'),
                DB::raw('CASE
        WHEN vsa_accounts.source = "saving" THEN COALESCE(approve_users.name, "Unknown Approved By")
        WHEN vsa_accounts.source = "other" THEN COALESCE(income_expences_approval_users.name, "Unknown Approved By")
        WHEN vsa_accounts.source = "loan" AND vsa_accounts.isLoan = true THEN COALESCE(loan_approval_users.name, "Unknown Approved By")
        ELSE COALESCE(loan_pay_approval_users.name, "Unknown Approved By") END as approved_by'),
                DB::raw('CASE
        WHEN vsa_accounts.source = "saving" THEN COALESCE(saving_member.name, "Unknown Member")
        WHEN vsa_accounts.source = "other" THEN ""
        WHEN vsa_accounts.source = "loan" AND vsa_accounts.isLoan = true THEN COALESCE(loan_member.name, "Unknown Member")
        ELSE COALESCE(loan_pay_member.name, "Unknown Member") END as member_name'),
                DB::raw('CASE
        WHEN vsa_accounts.source = "saving" THEN COALESCE(saving_member.regnumber, "Unknown Member")
        WHEN vsa_accounts.source = "other" THEN ""
        WHEN vsa_accounts.source = "loan" AND vsa_accounts.isLoan = true THEN COALESCE(loan_member.regnumber, "Unknown Member")
        ELSE COALESCE(loan_pay_member.regnumber, "Unknown Member") END as member_regnumber'),
                DB::raw('CASE
        WHEN vsa_accounts.source = "saving" THEN COALESCE(saving_members.created_at, "")
        WHEN vsa_accounts.source = "other" THEN COALESCE(income_expences.created_at, "")
        WHEN vsa_accounts.source = "loan" AND vsa_accounts.isLoan = true THEN COALESCE(loans.created_at, "")
        ELSE COALESCE(loan_pays.created_at, "") END as post_date'),
            )->orderByDesc('id')->get();


        // dd($journal_reports);
        return view('reports.journal_report', compact('journal_reports', '_start', '_end'));
    }
    public function loan_report(Request $request)
    {
        $_start = $request->start;
        $_end = $request->end;

        $start = \Carbon\Carbon::parse($request->start)->format('Y-m-d');
        $end = \Carbon\Carbon::parse($request->end)->format('Y-m-d');

        $loans = Loan::query()
            ->when($request->has('start') && $request->has('end'), function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })->where('status', 'approved')->where('loan_status', 'open')->orderByDesc('id')->get();

        return view('reports.loan_report', compact('loans', '_start', '_end'));
    }
}
