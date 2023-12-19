<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(User::where('status', '1')->with(['department'])->get());
        }
        $departments = Department::orderByDesc('id')->get();
        return view('users.index', compact('departments'));
    }
    public function all(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(User::with(['department'])->get());
        }
        return view('users.all');
    }
    public function inactive(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(User::where('status', '0')->with(['department'])->get());
        }
        return view('users.inactive');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'department' => 'required|exists:departments,id',
            'role' => 'required|in:0,1,2',
            'username' => 'required|min:4|unique:users,username',
            'savings' => 'required|numeric',
        ]);
        $request->merge([
            'department_id' => $request->department,
            'password' => bcrypt($request->username),
            'regnumber' => 'VFC' . str_pad(User::count() + 1, 3, '0', STR_PAD_LEFT),
        ]);

        try {
            User::create($request->all());
            return back()->with('success', 'User Registed Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'phone' => 'required|numeric|digits:10|unique:users,phone,' . $id,
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:0,1,2',
            'username' => 'required|min:4|unique:users,username,' . $id,
            'savings' => 'required|numeric',
            'status' => 'required',
        ]);

        try {
            User::find($id)->update($request->all());
            return back()->with('success', 'User Updated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function activate($id)
    {
        try {
            User::find($id)->update(['status' => '1']);
            return back()->with('success', 'User Activated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
    public function disactivate($id)
    {
        try {
            User::find($id)->update(['status' => '0']);
            return back()->with('success', 'User Disactivated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }
}
