<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index

    public function index()
    {
        return response()->json(User::with(['department'])->get());
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:0,1,2',
            'username' => 'required|min:4|unique:users,username',
        ]);
        $request->merge([
            'password' => bcrypt($request->username),
            'regnumber' => 'VFC' . str_pad(User::count() + 1, 3, '0', STR_PAD_LEFT),
        ]);

        try {
            User::create($request->all());
            return response()->json("User Registed", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("some thing went wrong",500);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$id,
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:0,1,2',
            'username' => 'required|min:4|unique:users,username,'.$id,
        ]);

        try {
            User::find($id)->update($request->all());
            return response()->json("User Updated", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("some thing went wrong",500);
        }
    }
    public function destroy($id)
    {
        User::findorfail($id)->delete();
        return response()->json("Department Deleted", 200);
    }
}
