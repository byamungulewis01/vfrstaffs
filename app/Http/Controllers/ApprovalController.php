<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Saving;
use App\Models\LoanPay;
use App\Models\SavingMember;
use Illuminate\Http\Request;
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
        Saving::findorfail($id)->update(['status' => 'approved']);
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
        Loan::findorfail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Loan Approved');
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
                'loan_pays.loan_id',
                '=',
                'approved_sum.loan_id'
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
        $loan_pays = (int)LoanPay::where('loan_id', $loanPay->loan_id)->sum('amount');

        if ($loan <= $loan_pays) {
            LoanPay::findorfail($id)->update(['status' => 'approved']);
            Loan::findorfail($loanPay->loan_id)->update(['loan_status' => 'closed']);
        } else {
            LoanPay::findorfail($id)->update(['status' => 'approved']);
        }
        return back()->with('success', 'Loan Approved');
    }
    public function monthly_loan_reject($id)
    {
        LoanPay::findorfail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Transaction Rejected');
    }
}
