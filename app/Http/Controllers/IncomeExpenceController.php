<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpence;
use Illuminate\Http\Request;

class IncomeExpenceController extends Controller
{
    //index

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(IncomeExpence::where('source','other')->orderByDesc('id')->get());
        }
        return view('income_expense.index');
    }
    public function monthly(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(IncomeExpence::whereNot('source','other')->orderByDesc('id')->get());
        }
        return view('income_expense.monthly');
    }
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|numeric',
            'type' => 'required',
            'comment' => 'required',
        ]);

        try {
            $existing = IncomeExpence::where('status', 'requested')->where('type', $request->type)->first();
            if ($existing) {
                return redirect()->back()->with('error', 'Please wait for approval of last request');
            }
            $request->merge(['user_id' => auth()->user()->id, 'source' => 'other']);
            IncomeExpence::create($request->all());
            return to_route('income_expences.index')->with('success', 'Registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong!! Ask Administrator');
        }
    }
}
