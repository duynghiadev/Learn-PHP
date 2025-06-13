<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('user.auth.login');
    }

    public function showLoginFormAdmin(){
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $user = User::where('email',$request->input('email'))->first();
        if($user && $user->status === User::STATUS['DE_ACTIVE']){
            return back()->withErrors([
                'login' => 'Tài khoản của bạn đã bị khóa'
            ])->withInput();
        }
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::guard('admin')->attempt(array('email' => $email,'password' => $password,'status' => User::STATUS['ACTIVE']))) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }
        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác'
        ])->withInput();
    }

    public function loginUser(Request $request){
        $user = Customer::where('email',$request->input('email'))->first();
        if($user && $user->status == User::STATUS_LOCKED){
            return back()->withErrors([
                'login' => 'Tài khoản của bạn đã bị khóa'
            ])->withInput();
        }
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::guard('web')->attempt(array('email' => $email,'password' => $password,'status' => Customer::STATUS_UNLOCKED))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác'
        ])->withInput();
    }
}
