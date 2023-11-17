<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:4',
        ]);
        $user = User::findorfail(auth()->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            auth()->logout();
            return back()->with('success', 'Password Changed Successfully');
        } else {
            return back()->with('error', 'Old Password Not Matched');
        }
    }
    // changePersonalDetails
    public function changePersonalDetails(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone,' . auth()->user()->id,
            'username' => 'required|unique:users,username,' . auth()->user()->id,
        ]);
        User::findorfail(auth()->user()->id)->update($request->all());
        return redirect()->back()->with('success', 'Personal Details Changed Successfully');
    }
}
