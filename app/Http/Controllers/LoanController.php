<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPay;
use App\Models\User;
use App\Models\LoanSetting;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Loan::with(['user', 'loan_setting', 'loan_pays'])->where('loan_status', 'open')->orderByDesc('id')->get());
        }
        $loanTypes = LoanSetting::all();
        return view('loans.index', compact('loanTypes'));
    }
    public function loan_closed(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Loan::with(['user', 'loan_setting', 'loan_pays'])->where('loan_status', 'closed')->orderByDesc('id')->get());
        }
        return view('loans.closed-loans');
    }

    public function store(Request $request)
    {
        $request->validate([
            'regnumber' => 'required|exists:users,regnumber',
            'amount' => 'required|min:1|numeric',
            'loan_type' => 'required',
            'installement' => 'required|numeric|min:1',
            'comment' => 'required',
        ]);
        try {
            $member = User::where('regnumber', $request->regnumber)->first();
            $existingLoan = Loan::where('user_id', $member->id)->where('loan_status', 'open')->where('status', 'requested')->where('loan_type', $request->loan_type)->first();
            if ($existingLoan) {
                return redirect()->back()->with('error', 'You already have anather loan');
            }

            $duplicateLoan = Loan::where('user_id', $member->id)->where('loan_status', 'open')->where('status', 'approved')->where('loan_type', $request->loan_type)->first();
            if ($duplicateLoan) {
                return redirect()->back()->with('error', 'You are not allowed to create two product at same people !!!');
            }

            $loan = LoanSetting::findorfail($request->loan_type);

            $tt = $request->amount * $loan->rate;
            $interest = ($tt / 100) * $request->installement;
            Loan::create(
                [
                    'user_id' => $member->id,
                    'loan' => $request->amount,
                    'interest' => $interest,
                    'installement' => $request->installement,
                    'comment' => $request->comment,
                    'loan_type' => $request->loan_type,
                ]
            );
            return to_route('loan.index')->with('success', 'Loan registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }

    public function show(Request $request, $id)
    {
        $loan = Loan::findorfail($id);
        $loan_pays = LoanPay::where('loan_id', $loan->id)->get();
        return view('loans.show', compact('loan', 'loan_pays'));
    }
    public function storeQCL(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'interest' => 'required|numeric',
            'comment' => 'required',
        ]);
        try {
            $request->merge(['loan_id' => $id]);
            $last = LoanPay::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last loan to be approved');
            }

            LoanPay::create($request->all());
            return back()->with('success', 'Quick Pay Loan Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function storePayOff(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'interest' => 'required|numeric',
            'comment' => 'required',
        ]);
        try {
            $last = LoanPay::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last loan to be approved');
            }

            $request->merge(['loan_id' => $id]);
            LoanPay::create($request->all());
            return back()->with('success', 'Loan Payed Off');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
}
