<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;

class OrderController
{
    public function cancelOrder($id){
        $order = Order::find($id);
        if ($order->status===Order::WAIT){
            $order->status = Order::CANCEL;
        }else if($order->status===Order::CONFIRM){
            $order->status = Order::REQUESTCANEL;
        }
        $order->save();
        return redirect(route('home.account'));
    }

    public function undoCancel($id){
        $order = Order::find($id);
        if ($order->status === Order::REQUESTCANEL){
            $order->status = Order::CONFIRM;
        }
        $order->save();
        return redirect(route('home.account'));
    }

}
