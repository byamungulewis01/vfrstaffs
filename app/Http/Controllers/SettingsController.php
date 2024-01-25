<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\BankAccount;
use App\Models\LoanSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //index
    public function index()
    {
        $departments = Department::orderByDesc('id')->get();
        $loanSettings = LoanSetting::all();
        $account = BankAccount::first()->account;
        return view('settings.index', compact('departments', 'loanSettings', 'account'));
    }

    public function storeDepartment(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments,name']);
        try {
            Department::create($request->all());
            return back()->with('success', 'Department Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function updateDepartment(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $id]);
        try {
            Department::findorfail($id)->update($request->all());
            return back()->with('success', 'Department Updated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroyDepartment($id)
    {
        try {
            Department::findorfail($id)->delete();
            return back()->with('success', 'Department Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function storeLoanSetting(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:loan_settings,name',
            'rate' => 'required|numeric',
            'isPenalty' => 'nullable'
        ]);
        $request->merge([
            'loan_id' => 'LT' . str_pad(LoanSetting::count() + 1, 2, '0', STR_PAD_LEFT),
            'user_id' => auth()->user()->id,
        ]);

        if ($request->has('isPenalty')) {
            $check = LoanSetting::where('isPenalty', true)->first();
            if ($check) {
                return back()->with('error', 'Penalty is already in Settings');
            }
            $request->merge(['isPenalty' => true,]);
        }

        try {
            LoanSetting::create($request->all());
            return back()->with('success', 'Setting Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function updateLoanSetting(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:loan_settings,name,' . $id,
            'rate' => 'required|numeric',
            'isPenalty' => 'nullable'
        ]);
        if ($request->has('isPenalty')) {
            $check = LoanSetting::where('isPenalty', true)->whereNot('id', $id)->first();
            if ($check) {
                return back()->with('error', 'Penalty is already in Settings');
            }
            $request->merge(['isPenalty' => true,]);
            LoanSetting::findorfail($id)->update($request->all());
            return back()->with('success', 'Setting Update Succesfully');
        }
        $request->merge(['user_id' => auth()->user()->id, 'isPenalty' => false]);


        try {
            LoanSetting::findorfail($id)->update($request->all());
            return back()->with('success', 'Setting Update Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function loginHistory()
    {
        $logs = DB::table('authentication_log')
            ->select('authentication_log.*', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'authentication_log.authenticatable_id')
            ->get();
        return view('settings.login-history', compact('logs'));
    }
    public function updateBankAccount(Request $request)
    {
        $request->validate([
            'account' => 'required|numeric|min:4',
        ]);
        try {
            BankAccount::first()->update($request->all()); //
            return back()->with('success', 'Account Update Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
