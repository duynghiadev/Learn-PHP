<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class CustomerController
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getList(Request $request)
    {

//        $customers = User::where(function ($query) use ($request){
//            if ($request->search != '') {
//                $query->where('name', 'like', "%" . $request->search . "%")
//                    ->orWhere('email', 'like', "%" . $request->search . "%")
//                    ->orWhere('phone', 'like', "%" . $request->search . "%");
//            }
//        }
        $customers = Customer::query()->orderBy('created_at','DESC')->get();
        return Datatables::of($customers)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                return '
                        <a style="cursor:pointer;" class="menu-link px-3 text-success reset_pass" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Reset mật khẩu" flow="up">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </a>';
            })
            ->editColumn('status', function ($customer) {
                if ($customer->status == Customer::STATUS_LOCKED){
                    return '
                        <a style="color: red; cursor:pointer;" class="menu-link px-3 change_status" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Mở tài khoản" flow="up">
                            <i class="fa-solid fa-lock text-danger" data-toggle="tooltip" data-placement="top" title="Mở khoá tài khoản"></i>
                        </a>';
                }
                if($customer->status == Customer::STATUS_UNLOCKED){
                    return '
                        <a style="color: red; cursor:pointer;text-align: center" class="menu-link px-3 change_status" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Khoá tài khoản" flow="up">
                        <i class="fa-solid fa-unlock text-primary" data-toggle="tooltip" data-placement="top" title="Khoá tài khoản"></i>
                        </a>';
                }
            })
            ->editColumn('name', function ($customer){
                return '<a href="#" style="text-decoration: none">
                <b>'.$customer->name.'</b>
            </a>';
            })
            ->rawColumns(['action', 'status','name'])
            ->make(true);
    }

    public function lock($id)
    {
        $customer = Customer::findOrFail($id);
        if($customer->status){
            $customer->status = Customer::STATUS_LOCKED;
        }else{
            $customer->status = Customer::STATUS_UNLOCKED;
        }
        $customer->save();
        return response()->json([
            'customer_status' =>  $customer->status,
            'status' => 200,
        ]);
    }

    public function resetPassword($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->password = Hash::make(Customer::PASSWORD_DEFAULT);
        $customer->save();
        return response()->json([
            'status' => 200,
        ]);
    }

}
