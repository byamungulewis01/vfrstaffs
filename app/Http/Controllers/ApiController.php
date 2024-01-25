<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saving;
use Illuminate\Http\Request;
use App\Models\IncomeExpence;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function incomeExpence()
    {
        return response()->json(IncomeExpence::where('source', 'other')->orderByDesc('id')->get());
    }
    public function monthlyIncomeExpence()
    {
        return response()->json(IncomeExpence::whereNot('source', 'other')->orderByDesc('id')->get());
    }
    public function savings()
    {
        return response()->json(Saving::with(['user'])->orderByDesc('id')->get());
    }
    public function savingsMember()
    {
        $usersWithTotalAmount = User::select(
            'users.*',
            DB::raw('SUM(saving_members.amount) as total_amount'),
            DB::raw('SUM(CASE WHEN saving_members.type = "withdraw" THEN saving_members.amount ELSE 0 END) as total_withdrawn_amount')
        )
            ->leftJoin('saving_members', function ($join) {
                $join->on('users.id', '=', 'saving_members.user_id')
                    ->where('saving_members.status', '=', 'approved');
            })->groupBy('users.id')->orderBy('users.name')->get();

        return response()->json($usersWithTotalAmount);
    }
    public function loanMembers()
    {
        return response()->json(User::with(['department'])->orderBy('name')->get());
    }
}
