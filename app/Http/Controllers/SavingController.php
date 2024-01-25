<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saving;
use App\Models\SavingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller {
    //index
    public function index() {

        return view('savings.index');
    }
    // members
    public function members() {

        return view('savings.members');
    }
    public function showMember(Request $request, $id) {

        $user = User::select('users.*', DB::raw('SUM(saving_members.amount) as total_amount'))
            ->join('saving_members', function ($join) use ($id) {
                $join->on('users.id', '=', 'saving_members.user_id')
                    ->where('users.id', $id)->where('saving_members.status', 'approved')
                    ->where('saving_members.type','deposit');
            })->first();

        $savings = SavingMember::where('user_id', $id)->where('status', 'approved')->get();

        return view('savings.member-show', compact('user', 'savings', 'id'));
    }
    public function show(Request $request, $id) {
        $members = SavingMember::where('saving_id', $id)->with(['user'])->get();
        if($request->ajax()) {
            return response()->json($members);
        }
        $saving = Saving::findorfail($id);
        return view('savings.show', compact('saving'));
    }
    public function create(Request $request) {
        if($request->ajax()) {
            return response()->json(User::with(['department'])->get());
        }
        $users = User::whereNot('savings',0)->get();
        return view('savings.create', compact('users'));
    }
    // store
    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric',
            'comment' => 'required',
            'members' => 'required|array',
        ]);
        dd($request->all());
        try {
            // Check if there is already a saving entry for the current month
            $currentMonth = now()->format('m');
            $currentYear = now()->format('Y');

            $existingSaving = Saving::whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)->first();

            if($existingSaving) {
                return redirect()->back()->with('error', 'You already have a saving entry for the current month');
            }
            $saving = Saving::create([
                'amount' => $request->amount,
                'comment' => $request->comment,
                'user_id' => auth()->user()->id,
            ]);
            if($saving) {
                foreach($request->members as $member) {
                    SavingMember::create([
                        'user_id' => explode(',', $member)[0],
                        'amount' => explode(',', $member)[1],
                        'comment' => $request->comment,
                        'saving_id' => $saving->id,
                    ]);
                }
            } else {
                return back()->with('error', 'some thing went wrong');
            }
            return to_route('saving.index')->with('success', 'Saving Created Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function memberSaving(Request $request, $id) {
        $request->validate([
            'amount' => 'required|numeric',
            'comment' => 'required',
            'type' => 'required',
        ]);
        try {
            $last = Saving::where('saving_by', $id)->where('status', 'requested')->first();
            if($last) {
                return back()->with('error', 'You already have a saving request for the current month');
            }
            $saving = Saving::create([
                'amount' => $request->amount,
                'comment' => $request->comment,
                'type' => $request->type,
                'saving_by' => $id,
                'user_id' => auth()->user()->id,
            ]);
            if($saving) {
                SavingMember::create([
                    'user_id' => $id,
                    'type' => $request->type,
                    'amount' => $request->amount,
                    'comment' => $request->comment,
                    'saving_id' => $saving->id,
                ]);
            } else {
                return back()->with('error', 'some thing went wrong');
            }
            return back()->with('success', 'Saving Created Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
}
