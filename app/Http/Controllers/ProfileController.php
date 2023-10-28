<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return response()->json(auth()->user());
        // return response()->json(auth()->user()->with('department')->first());
    }
    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'name' => 'required|string|min:4',
            'phone' => 'required|numeric|digits:10|unique:users,phone,' . $id,
            'username' => 'required|min:4|unique:users,username,' . $id,
        ]);

        try {
            User::find($id)->update($request->all());
            return response()->json("Profile Updated", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("some thing went wrong", 500);
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::findorfail(auth()->user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json('Password Changed Successfully');
        } else {
            return response()->json('Current Password Not Matched');
        }
    }
}
