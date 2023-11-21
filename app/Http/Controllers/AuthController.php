<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // __construct
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //index
    public function index()
    {
        session()->put('url.intended', url()->previous());
        // dd(url()->current());
        return view('auth.login');
    }
    // login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|min:4',
        ]);
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            Auth::logoutOtherDevices($request->password);
            $request->session()->regenerate();
            if (auth()->user()->status == '0') {
                return back()->with('error', 'Your account is locked, please contact system administrator');
            } else {
                return redirect()->intended('home');
            }
        }
        return redirect()->back()->with('error', 'Invalid login details');
    }

}
