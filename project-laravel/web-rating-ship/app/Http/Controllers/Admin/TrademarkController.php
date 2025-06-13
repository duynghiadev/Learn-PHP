<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Trademark;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;


class TrademarkController extends Controller
{
    public  function index()
    {
        return view('admin.trademarks.index');
    }

    
    public function getlist(Request $request)
    {
//        $name = $request->get('search');
//        $trademarks = Trademark::where('name', 'like', "%" . $name . "%")
        $trademarks = Trademark::orderBy('created_at','DESC')->get();
        return Datatables::of($trademarks)
            ->addIndexColumn()
            ->editColumn('name', function ($trademark){
                return '<a href=""><b>'.$trademark->name.'</b></a>';
            })
            ->editColumn('image', function ($trademark) {
                return '
                    <a href="" class="symbol symbol-50px">
                        <div class="symbol-label">
                            <img
                                src="'.url(Storage::url($trademark->image)).'"
                                alt="Hình ảnh" class="w-100"
                            />
                        </div>
                    </a>
                ';
            })
            ->addColumn('action', function ($trademark) {
                return '
                     <a href="'.route('admin.trademarks.edit', ['id' => $trademark->id]).'"
                       data-placement="top"
                       class="menu-link px-3" data-toggle="tooltip"
                       style="cursor:pointer;"
                       tooltip="Chỉnh sửa"
                       flow="up"
                       class="btn btn-xs btn-primary">
                        <i class="fa-solid fa-pen-to-square text-warning"></i>
                     </a>

                     <a
                        style="cursor:pointer;"
                        data-id="'.$trademark->id.'" data-token="{{csrf_token()}}"
                        tooltip="Xóa"
                        flow="up"
                        class="menu-link px-3 text-warning delete">
                        <i style="color:red" class="fa-solid fa-trash"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function ($trademark) {
                return '
                            <div >
                               '.date("H:i | d/m/Y", strtotime($trademark->created_at)).'
                            </div>';

            })
            ->rawColumns(['name', 'image','slug', 'action', 'created_at'])
            ->make(true);

    }

    public function create()
    {
        return view('admin.trademarks.create');
    }

    public  function store(Request $request)
    {
        $data = $request->all();
        $trademark = new Trademark;
        $trademark->name = $data['name'];
        // $trademark->user_id = Auth::guard('admin')->id();
//        $trademark->user_id = 1;
        $trademark->slug = $data['slug'];
        if($request->hasFile('images')){
            $disk = 'public';
            $path = $request->file('images')->store('images', $disk);
            $trademark->image = $path;
        }
        $trademark->save();
        $request->session()->flash('success','Thêm mới thành công');
        return redirect()->route('admin.trademarks.index');
    }

    public  function edit($id)
    {
        $trademark = Trademark::findOrFail($id);
        return view('admin.trademarks.edit')->with([
            'trademark' => $trademark,
        ]);
    }

    public  function update(Request $request,$id)
    {
        $data = $request->all();
        $trademark = Trademark::findOrFail($id);
//        $trademark->user_id = 1;
        $trademark->name = $data['name'];
        $trademark->slug = $data['slug'];
        if($request->hasFile('image')){
            $disk = 'public';
            $path = $request->file('image')->store('images', $disk);
            $trademark->image = $path;
        };
        $trademark->update();
        $request->session()->flash('success', 'Cập nhật thành công');
        DB::commit();
        return redirect()->route('admin.trademarks.index');
    }

    public function destroy($id)
    {
            $check = Product::where('trademark_id', $id)->first();
            if(isset($check)){
                $check = true;
                return response()->json([
                    'error' => 'Thương hiệu đã được sử dụng Không thể xóa!',
                    'check' => $check
                ]);
            }else{
                Trademark::destroy($id);
                return response()->json(['success' => 'Thành công']);
            }
    }
}
