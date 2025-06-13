<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AccountController
{
    public  function index(){
        $orders = Order::with(['order_details'])->where('customer_id',Auth::guard('web')->id())
            ->orderBy('created_at','DESC')->get();
        return view('user.account.index')->with([
            'orders' => $orders
        ]);
    }

}
