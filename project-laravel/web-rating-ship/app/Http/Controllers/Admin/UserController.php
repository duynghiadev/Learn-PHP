<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getList(Request $request)
    {

//        $users = User::where(function ($query) use ($request){
//            if ($request->search != '') {
//                $query->where('name', 'like', "%" . $request->search . "%")
//                    ->orWhere('email', 'like', "%" . $request->search . "%")
//                    ->orWhere('phone', 'like', "%" . $request->search . "%");
//            }
//        })
            $users = User::query()->orderBy('created_at','DESC')->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                        <a href="'.route("admin.users.edit",["id" => $user->id]).'" class="menu-link px-3 text-warning" style="text-decoration: none" tooltip="Cập nhật tài khoản" flow="up">
							<i class="fa-solid fa-pen-to-square"></i>
                        <a style="color: red; cursor:pointer; text-decoration: none"" class="menu-link px-3 show_confirm" data-id="'.$user->id.'" data-token="{{csrf_token()}}" tooltip="Xoá tài khoản" flow="up">
                             <i class="fa-solid fa-trash"></i>
                        </a>
                        <a style="cursor:pointer;" class="menu-link px-3 text-success reset_pass" data-id="'.$user->id.'" data-token="{{csrf_token()}}" tooltip="Reset mật khẩu" flow="up">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </a>';
            })
            ->editColumn('status', function ($user) {
                if ($user->status == User::STATUS_LOCKED){
                    return '
                        <a style="color: red; cursor:pointer;" class="menu-link px-3 status_check" data-id="'.$user->id.'" data-token="{{csrf_token()}}" tooltip="Mở tài khoản" flow="up">
                            <i class="fa-solid fa-lock text-danger" data-toggle="tooltip" data-placement="top" title="Mở khoá tài khoản"></i>
                        </a>';
                }
                if($user->status == User::STATUS_UNLOCKED){
                    return '
                        <a style="color: red; cursor:pointer;text-align: center" class="menu-link px-3 status_check" data-id="'.$user->id.'" data-token="{{csrf_token()}}" tooltip="Khoá tài khoản" flow="up">
                        <i class="fa-solid fa-unlock text-primary" data-toggle="tooltip" data-placement="top" title="Khoá tài khoản"></i>
                        </a>';
                }
            })
            ->editColumn('name', function ($user){
                return '<a href="#" style="text-decoration: none"><b>'.$user->name.'</b></a>';
            })
            ->rawColumns(['action', 'status','name'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->password = $data['password'];
        $user->status= User::STATUS_UNLOCKED;
        $user->save();
        $request->session()->flash('success', 'Tạo tài khoản người dùng thành công');
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->save();
        $request->session()->flash('success', 'Cập nhật tài khoản người dùng thành công');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'success' => 'Record has been deleted successfully!',
            'status' => 200
        ]);
    }

    public function lock($id)
{
    $user = User::findOrFail($id);
        if($user->status){
            $user->status = User::STATUS_LOCKED;
        }else{
            $user->status = User::STATUS_UNLOCKED;
        }
    $user->save();
        return response()->json([
            'staff_status' =>  $user->status,
            'status' => 200,
        ]);
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make(User::PASSWORD_DEFAULT);
        $user->save();
        return response()->json([
            'status' => 200,
        ]);
    }

}
