<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Saving;
use App\Models\LoanPay;
use App\Models\LoanTopup;
use App\Models\SavingMember;
use App\Models\VsaAccount;
use Illuminate\Http\Request;
use App\Models\IncomeExpence;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    //requests
    public function requests(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Saving::with(['user'])->where('status', 'requested')->orderByDesc('id')->get());
        }
        return view('savings.requests');
    }
    public function requestShow(Request $request, $id)
    {
        $members = SavingMember::where('saving_id', $id)->with(['user'])->get();
        if ($request->ajax()) {
            return response()->json($members);
        }
        $saving = Saving::findorfail($id);
        return view('savings.show', compact('saving'));
    }
    public function approve($id)
    {

        $saving = Saving::findorfail($id);

        $approved = Saving::findorfail($id)->update(['status' => 'approved']);
        if ($approved) {
            SavingMember::where('saving_id', $id)->update(['status' => 'approved']);
            $type = SavingMember::where('saving_id', $id)->first()->type;
            VsaAccount::create([
                'amount' => $saving->amount,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'source' => 'saving',
                'comment' => $saving->comment,
                'saving_by' => $saving->saving_by
            ]);
        }
        return back()->with('success', 'Transaction Approved');
    }
    public function approve_all()
    {
        $savings = Saving::where('status', 'requested')->get();

        foreach ($savings as $saving) {
            $saving->update(['status' => 'approved']);
            SavingMember::where('saving_id', $saving->id)->update(['status' => 'approved']);
            $type = SavingMember::where('saving_id', $saving->id)->first()->type;
            VsaAccount::create([
                'amount' => $saving->amount,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'source' => 'saving',
                'comment' => $saving->comment,
                'saving_by' => $saving->saving_by
            ]);
        }

        return back()->with('success', 'Transaction Approved');
    }
    public function reject($id)
    {
        Saving::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Transaction Rejected');
    }
    public function loans(Request $request)
    {
        $loans = Loan::with(['user', 'loan_setting', 'loan_pays'])->where('status', 'requested')->orderByDesc('id')->get();
        if ($request->ajax()) {
            return response()->json($loans);
        }
        return view('loans.requests');
    }
    public function loan_approve($id)
    {
        $loan = Loan::findorfail($id);
        $loan->update(['status' => 'approved']);
        if ($loan) {
            VsaAccount::create([
                'amount' => $loan->loan,
                'type' => 'withdraw',
                'user_id' => auth()->user()->id,
                'source' => 'loan',
                'comment' => $loan->comment,
            ]);
        }

        return back()->with('success', 'Loan Approved');
    }
    public function loan_approve_all()
    {
        $loans = Loan::where('status', 'requested')->get();
        foreach ($loans as $loan) {
            $loan->update(['status' => 'approved']);
            VsaAccount::create([
                'amount' => $loan->loan,
                'type' => 'withdraw',
                'user_id' => auth()->user()->id,
                'source' => 'loan',
                'comment' => $loan->comment,
            ]);
        }

        return back()->with('success', 'Loans Approved');
    }
    public function loan_reject($id)
    {
        Loan::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Transaction Rejected');
    }
    public function monthly_request_loans(Request $request)
    {
        $loans = LoanPay::with(['loan.user'])->select('loan_pays.*', DB::raw('COALESCE(approved_sum.amount, 0) as approved_sum'))
            ->leftJoin(
                DB::raw('(SELECT loan_id, SUM(amount + interest) as amount FROM loan_pays WHERE status = "approved" GROUP BY loan_id) as approved_sum'),
                'loan_pays.loan_id', '=', 'approved_sum.loan_id'
            )->where('loan_pays.status', 'requested')->orderByDesc('loan_pays.id')->get();
        if ($request->ajax()) {
            return response()->json($loans);
        }
        return view('loans.monthly-requests');
    }
    public function monthly_loan_approve($id)
    {
        $loanPay = LoanPay::findorfail($id);
        $loan = Loan::find($loanPay->loan_id)->loan;
        $loan_pays = (int) LoanPay::where('loan_id', $loanPay->loan_id)->sum('amount');

        $remain_interest = Loan::find($loanPay->loan_id)->interest - $loanPay->interest;

        if ($loan <= $loan_pays) {
            LoanPay::findorfail($id)->update(['status' => 'approved', 'approved_by' => auth()->user()->id]);
            Loan::findorfail($loanPay->loan_id)->update(['loan_status' => 'closed', 'remain_interest' => 0]);
        } else {
            LoanPay::findorfail($id)->update(['status' => 'approved', 'approved_by' => auth()->user()->id]);
            Loan::findorfail($loanPay->loan_id)->update(['remain_interest' => $remain_interest]);

        }
        IncomeExpence::create([
            'amount' => $loanPay->interest,
            'type' => 'income',
            'user_id' => auth()->user()->id,
            'comment' => $loanPay->comment,
            'source' => 'interest',
            'status' => 'approved',
        ]);

        // array of data
        $data = [[
            'amount' => $loanPay->interest,
            'type' => 'deposit',
            'user_id' => auth()->user()->id,
            'source' => 'interest',
            'comment' => $loanPay->comment,
        ], [
            'amount' => $loanPay->amount,
            'type' => 'deposit',
            'user_id' => auth()->user()->id,
            'source' => 'loan',
            'comment' => $loanPay->comment,
        ]
        ];

        foreach ($data as $value) {
            VsaAccount::create($value);
        }

        return back()->with('success', 'Loan Approved');
    }
    public function monthly_loan_approve_all()
    {
        $loanPayes = LoanPay::where('status', 'requested')->get();
        foreach ($loanPayes as $loanPay) {
            $loan = Loan::find($loanPay->loan_id)->loan;
            $loan_pays = (int) LoanPay::where('loan_id', $loanPay->loan_id)->sum('amount');
            $remain_interest = Loan::find($loanPay->loan_id)->interest - $loanPay->interest;

            if ($loan <= $loan_pays) {
                LoanPay::findorfail($loanPay->id)->update(['status' => 'approved', 'approved_by' => auth()->user()->id]);
                Loan::findorfail($loanPay->loan_id)->update(['loan_status' => 'closed', 'remain_interest' => 0]);
            } else {
                LoanPay::findorfail($loanPay->id)->update(['status' => 'approved', 'approved_by' => auth()->user()->id]);
                Loan::findorfail($loanPay->loan_id)->update(['remain_interest' => $remain_interest]);
            }
            IncomeExpence::create([
                'amount' => $loanPay->interest,
                'type' => 'income',
                'user_id' => auth()->user()->id,
                'comment' => $loanPay->comment,
                'source' => 'interest',
                'status' => 'approved',
            ]);

            // array of data
            $data = [[
                'amount' => $loanPay->interest,
                'type' => 'deposit',
                'user_id' => auth()->user()->id,
                'source' => 'interest',
                'comment' => $loanPay->comment,
            ], [
                'amount' => $loanPay->amount,
                'type' => 'deposit',
                'user_id' => auth()->user()->id,
                'source' => 'loan',
                'comment' => $loanPay->comment,
            ]
            ];

            foreach ($data as $value) {
                VsaAccount::create($value);
            }
        }

        return back()->with('success', 'Loan Approved');
    }
    public function monthly_loan_reject($id)
    {
        LoanPay::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Transaction Rejected');
    }


    public function restructure()
    {
        $loans = LoanTopup::where('status', 'requested')->orderByDesc('id')->get();
        return view('loans.restructure', compact('loans'));
    }
    public function restructure_approve($id)
    {
        $loan_topup = LoanTopup::findorfail($id);
        $loan_pays = LoanPay::where('loan_id', $loan_topup->loan_id)->where('status', 'approved')->get();


        $rloan = $loan_topup->loan->loan - $loan_pays->sum('amount');
        $rtimes = $loan_topup->loan->installement - $loan_pays->count();
        $ton = $loan_topup->loan->loan_setting->rate;

        $newloan = $rloan + $loan_topup->amount;
        $tt = $newloan * $ton;
        $newint = ($tt / 100) * $loan_topup->instrument;

        $loan_topup->update(['status' => 'approved']);

        Loan::findorfail($loan_topup->loan_id)->update(['loan' => $newloan, 'interest' => $newint, 'installement' => $loan_topup->instrument]);

        return back()->with('success', 'Loan Restructured Successfully');

    }
    public function restructure_approve_all()
    {
        $loan_topups = LoanTopup::where('status', 'requested')->get();

        foreach ($loan_topups as $loan_topup) {
            $loan_pays = LoanPay::where('loan_id', $loan_topup->loan_id)->where('status', 'approved')->get();

            $rloan = $loan_topup->loan->loan - $loan_pays->sum('amount');
            $rtimes = $loan_topup->loan->installement - $loan_pays->count();
            $ton = $loan_topup->loan->loan_setting->rate;

            $newloan = $rloan + $loan_topup->amount;
            $tt = $newloan * $ton;
            $newint = ($tt / 100) * $loan_topup->instrument;

            $loan_topup->update(['status' => 'approved']);

            Loan::findorfail($loan_topup->loan_id)->update(['loan' => $newloan, 'interest' => $newint, 'installement' => $loan_topup->instrument]);
        }

        return back()->with('success', 'Loan Restructured Successfully');

    }

    public function restructure_reject($id)
    {
        LoanTopup::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Loan Restructuring Rejected');
    }

    public function income_expenses(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(IncomeExpence::where('status', 'requested')->orderByDesc('id')->get());
        }
        return view('income_expense.request');
    }
    public function income_expenses_approve($id)
    {
        $income = IncomeExpence::findorfail($id);
        $type = ($income->type == 'income') ? 'deposit' : 'withdraw';
        $approved = $income->update(['status' => 'approved']);
        if ($approved) {
            VsaAccount::create([
                'amount' => $income->amount,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'source' => $income->source,
                'comment' => $income->comment,
            ]);
        }
        return back()->with('success', 'Approved Successfully');
    }
    public function income_expenses_reject($id)
    {
        IncomeExpence::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Rejected');
    }
    public function income_expenses_approve_all()
    {
        $incomes = IncomeExpence::where('status', 'requested')->get();
        foreach ($incomes as $income) {
            $type = ($income->type == 'income') ? 'deposit' : 'withdraw';
            $income->update(['status' => 'approved']);
            VsaAccount::create([
                'amount' => $income->amount,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'source' => $income->source,
                'comment' => $income->comment,
            ]);
        }

        return back()->with('success', 'Approved Successfully');
    }
}
