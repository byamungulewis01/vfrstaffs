<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\LoanPay;
use App\Models\LoanSetting;
use App\Models\SavingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //savings
    public function savings()
    {
        $user = User::select('users.*', DB::raw('SUM(saving_members.amount) as total_amount'))
            ->join('saving_members', 'users.id', '=', 'saving_members.user_id')->where('users.id', auth()->user()->id)->first();
        $savings = SavingMember::where('user_id', auth()->user()->id)->orderByDesc('id')->get();
        return view('member.savings', compact('savings', 'user'));
    }
    // loans
    public function loans(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Loan::with(['user', 'loan_setting', 'loan_pays'])->where('user_id', auth()->user()->id)->orderByDesc('id')->get());
        }
        $loanTypes = LoanSetting::all();
        return view('member.loans', compact('loanTypes'));
    }
    public function store_loan(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|numeric',
            'loan_type' => 'required',
            'installement' => 'required|numeric|min:1',
            'comment' => 'required',
        ]);
        try {
            $existingLoan = Loan::where('user_id', auth()->user()->id)->where('loan_status', 'open')->where('status', 'requested')->where('loan_type', $request->loan_type)->first();
            if ($existingLoan) {
                return redirect()->back()->with('error', 'You already have anather loan');
            }

            $duplicateLoan = Loan::where('user_id', auth()->user()->id)->where('loan_status', 'open')->where('status', 'approved')->where('loan_type', $request->loan_type)->first();
            if ($duplicateLoan) {
                return redirect()->back()->with('error', 'You are not allowed to create two product at same people !!!');
            }

            $loan = LoanSetting::findorfail($request->loan_type);

            $tt = $request->amount * $loan->rate;
            $interest = ($tt / 100) * $request->installement;
            Loan::create(
                [
                    'user_id' => auth()->user()->id,
                    'loan' => $request->amount,
                    'interest' => $interest,
                    'installement' => $request->installement,
                    'comment' => $request->comment,
                    'loan_type' => $request->loan_type,
                ]
            );
            return to_route('member.loans')->with('success', 'Loan registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }

    public function show_loan(Request $request, $id)
    {
        $loan = Loan::findorfail($id);
        $loan_pays = LoanPay::where('loan_id', $loan->id)->get();
        return view('member.show-loan', compact('loan', 'loan_pays'));
    }
}
