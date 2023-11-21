<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    //index
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     return response()->json(User::with(['department'])->get());
        // }
        return view('savings.index');
    }
    public function create(Request $request)
    {

          if ($request->ajax()) {
            return response()->json(User::with(['department'])->get());
        }
        $users = User::all();
        return view('savings.create',compact('users'));
    }
    // store
    public function store(Request $request)
    {
        // $request->validate([
        //     'savings' => 'required',
        //     'comment' => 'required',
        //     'members' => 'required|array',

        // ]);
        dd($request->all());
    }
}
