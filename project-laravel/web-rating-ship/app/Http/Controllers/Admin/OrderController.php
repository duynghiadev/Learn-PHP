<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user','customer'])->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function  getList(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($orders) {
                if($orders->status == Order::WAIT) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 text-warning confirmOrder"
                         style="cursor:pointer;"
                         tooltip="Xác nhận" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fa-solid fa-circle-check"></i>
                      </a>
                       <a
                            data-id="'.$orders->id.'"
                            style="color: red; cursor:pointer;"
                            class="menu-link px-3 cancelOrder" data-token="{{csrf_token()}}"
                            tooltip="Huỷ" flow="up">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                    ';
                } else if($orders->status == Order::CONFIRM) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 text-primary shipping"
                         style="cursor:pointer"
                         tooltip="Giao hàng" flow="up" data-token="{{csrf_token()}}">
                        <i class="fa-solid fa-truck"></i>
                      </a>
                       <a
                            data-id="'.$orders->id.'"
                            style="color: red; cursor:pointer;"
                            class="menu-link px-3 cancelOrder" data-token="{{csrf_token()}}"
                            tooltip="Huỷ" flow="up">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                    ';
                } else if($orders->status == Order::SHIPPING) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 complete"
                         style="cursor:pointer;color: mediumpurple"
                         tooltip="Đã giao" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fas fa-calendar-check"></i>
                      </a>
                    ';
                } else if($orders->status == Order::REQUESTCANEL){
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 cancelOrder"
                         style="cursor:pointer;color: red"
                         tooltip="Xác nhận huỷ" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fas fa-calendar-times"></i>
                      </a>
                    ';
                };
            })
            ->editColumn('status', function ($orders) {
                if($orders->status == Order::WAIT)
                {
                    return '<span style="background: orange;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::CONFIRM)
                {
                    return '<span style="background: dodgerblue;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::CANCEL)
                {
                    return '<span style="background: darkgray;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::SHIPPING)
                {
                    return '<span style="background: plum;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::COMPLETE)
                {
                    return '<span style="background: greenyellow;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }else{
                    return '<span style="background: red;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }

            })
            ->editColumn('update_by', function ($orders) {
                if ($orders->user){
                    return '<b>'.$orders->user->name.'</b>';
                }else {
                    return '<b></b>';
                }
            })
            ->editColumn('customer_id', function ($orders) {
                if(!empty($orders->customer))
                {
                    return '<a href="#" style="text-decoration: none"><b>'.$orders->customer->name.'</b></a>';
                }
            })
            ->editColumn('created_at', function ($orders) {
                return '<b>'. date("H:i | d/m/Y", strtotime($orders->created_at)).'</b>';
            })
            ->editColumn('total', function ($orders) {
                return '<b>'. number_format($orders->total,0, ',', '.').'</b>';
            })
            ->editColumn('id', function ($orders) {
                return '<a href="#" style="text-decoration: none"><b>'.$orders->id.'</b></a>';
            })
            ->editColumn('payment_text', function ($orders) {
                return '<b>'. $orders->payment_text.'</b>';
            })
            ->rawColumns(['action', 'status','update_by','customer_id','created_at','total','id','payment_text'])
            ->make(true);
    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');

        // if()


        $order->save();
        if ($order) {
            return response()->json([
                'success' => 'Cập nhật đơn hàng thành công',
            ]);
        }
        return response()->json(['error' => 'Cập nhật đơn hàng thất bại']);
    }

}

