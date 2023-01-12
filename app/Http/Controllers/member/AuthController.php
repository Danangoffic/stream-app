<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('member.register');
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'password' => 'required'
        ]);
        $data = $request->except('_token');
        $data['role'] = 'member';
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('member.login')->with('success', 'Register account is success');
    }

    public function login()
    {
        return view('member.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $checking_email = User::where('email', $request->email)->first();
        if(!$checking_email){
            return back()->withErrors(['email' => "Email not found, please try again"]);
        }

        $credentials = $request->only(['email', 'password']);
        $credentials['role'] = 'member';

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('member.dashboard');
        }else{
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('member.login');
    }

    public function settings()
    {

    }

    public function update_setting(Request $request)
    {
        # code...
    }
}
