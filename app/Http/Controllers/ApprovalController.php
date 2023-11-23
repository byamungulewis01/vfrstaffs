<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\SavingMember;
use Illuminate\Http\Request;

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
}
