<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\LoanPay;
use App\Models\LoanTopup;
use App\Models\LoanSetting;
use App\Imports\LoansImport;
use App\Models\VsaAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Loan::with(['user', 'loan_setting', 'loan_pays'])->where('status', 'approved')->where('loan_status', 'open')->orderByDesc('id')->get());
        }
        $loanTypes = LoanSetting::where('isPenalty', false)->get();
        return view('loans.index', compact('loanTypes'));
    }
    public function create(Request $request)
    {
        $loanTypes = LoanSetting::where('isPenalty', false)->get();
        return view('loans.create', compact('loanTypes'));
    }
    public function history(Request $request)
    {
        $loans = LoanPay::with(['loan.user', 'approval'])->select('loan_pays.*', DB::raw('COALESCE(approved_sum.amount, 0) as approved_sum'))
            ->leftJoin(
                DB::raw('(SELECT loan_id, SUM(amount + interest) as amount FROM loan_pays WHERE status = "approved" GROUP BY loan_id) as approved_sum'),
                'loan_pays.loan_id',
                '=',
                'approved_sum.loan_id'
            )->where('loan_pays.status', 'approved')->orderByDesc('loan_pays.id')->get();
        if ($request->ajax()) {
            return response()->json($loans);
        }
        return view('loans.history');
    }
    public function payment(Request $request)
    {
        $loans = Loan::where('status', 'approved')->where('loan_status', 'open')->orderByDesc('id')->get();
        return view('loans.payment', compact('loans'));
    }
    public function store_payment(Request $request)
    {
        // dd($request->all());
        $request->validate(['comment' => 'required', 'members' => 'required|array']);
        try {
            foreach ($request->members as $member) {
                $loan = Loan::findorfail($member);
                $_loan = round($loan->loan / $loan->installement);
                $interest = round($loan->interest / $loan->installement);

                LoanPay::create([
                    'interest' => $interest,
                    'amount' => $_loan,
                    'loan_id' => $member,
                    'comment' => $request->comment,
                    'posted_by' => auth()->user()->id,
                    'user_id' => $member->user_id,
                ]);
            }
            return back()->with('success', 'Quick Pay Loan Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
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
                    'posted_by' => auth()->user()->id
                ]
            );
            return redirect()->back()->with('success', 'Loan registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required',
        ]);
        // dd($request->excel_file);
        try {
            Excel::import(new LoansImport, request()->file('excel_file'));
            return to_route('loan.index')->with('success', 'Loan registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Request $request, $id)
    {

        $loan = Loan::findorfail($id);
        $loan_pays = LoanPay::where('loan_id', $loan->id)->where('status', 'approved')->get();
        return view('loans.show', compact('loan', 'loan_pays'));
    }
    public function closed_show(Request $request, $id)
    {
        $loan = Loan::findorfail($id);
        $loan_pays = LoanPay::where('loan_id', $loan->id)->where('status', 'approved')->get();
        return view('loans.show-closed', compact('loan', 'loan_pays'));
    }

    public function storeQCL(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'interest' => 'required|numeric',
            'comment' => 'required',
        ]);
        $loan = Loan::findorfail($id);
        try {
            $request->merge(['loan_id' => $id, 'posted_by' => auth()->user()->id, 'user_id' => $loan->user_id]);
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
        $loan = Loan::findorfail($id);

        try {
            $last = LoanPay::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last loan to be approved');
            }

            $request->merge(['loan_id' => $id, 'posted_by' => auth()->user()->id, 'user_id' => $loan->user_id]);
            LoanPay::create($request->all());
            return back()->with('success', 'Loan Payed Off');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function storePartialLoan(Request $request, $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'amount' => 'required|numeric',
            'penalty' => 'required|numeric',
            'interest' => 'required|numeric',
            'comment' => 'required',
        ]);
        $loan = Loan::findorfail($id);
        try {
            $request->merge(['loan_id' => $id, 'isPartial' => true, 'posted_by' => auth()->user()->id,'user_id' => $loan->user_id]);
            $last = LoanPay::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last loan to be approved');
            }

            LoanPay::create($request->all());
            return back()->with('success', 'Partial Pay Loan Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function topup(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'instrument' => 'required|numeric',
        ]);
        try {
            $last = LoanTopup::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last request to be approved');
            }

            $request->merge(['loan_id' => $id, 'type' => 'topup', 'user_id' => auth()->user()->id]);
            LoanTopup::create($request->all());
            return back()->with('success', 'Loan Topup Requested');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function restructure(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'instrument' => 'required|numeric',
        ]);
        try {
            $last = LoanTopup::where('loan_id', $id)->where('status', 'requested')->first();
            if ($last) {
                return back()->with('error', 'Please wait for last request to be approved');
            }

            $request->merge(['loan_id' => $id, 'type' => 'restructure', 'user_id' => auth()->user()->id]);
            LoanTopup::create($request->all());
            return back()->with('success', 'Loan Restructuring Requested');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function reverse($id)
    {
        $loanPay = LoanPay::findorfail($id)->delete();
        if ($loanPay) {
            VsaAccount::where('tranking', $id)->delete();
        }
        return back()->with('success', 'Loan reversed successfully');
    }
}
