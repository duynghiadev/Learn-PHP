<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = Hash::make($request->input('password'));
        $customer->status = User::STATUS['ACTIVE'];
        $customer->address = $request->input('address');
        $customer->gender = (int)$request->input('gender');
        $customer->phone = $request->input('phone');
        $customer->save();
        $request->session()->flash('success','Đăng ký tài khoản thành công!');
        return redirect()->route('user.login.form');
    }
}
