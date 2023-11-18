<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
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
        return view('settings.index', compact('departments', 'loanSettings'));
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
        ]);
        $request->merge([
            'loan_id' => 'LT' . str_pad(LoanSetting::count() + 1, 2, '0', STR_PAD_LEFT),
            'user_id' => auth()->user()->id,
        ]);
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
        ]);
        $request->merge(['user_id' => auth()->user()->id]);
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
        return view('settings.login-history',compact('logs'));
    }
}
