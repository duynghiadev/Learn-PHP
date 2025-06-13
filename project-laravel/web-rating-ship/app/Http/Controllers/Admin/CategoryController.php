<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;


class CategoryController extends Controller
{
    public  function index()
    {
        return view('admin.categories.index');
    }

    public function getList(Request $request)
    {
//        $name = $request->get('search');
//        $categories = Category::where('name', 'like', "%" . $name . "%")
        $categories = Category::orderBy('created_at','DESC')->get();
        return Datatables::of($categories)
            ->addIndexColumn()
            ->editColumn('name', function ($category){
                return '<a href=""><b>'.$category->name.'</b></a>';
            })
            ->editColumn('image', function ($category) {
                return '
                    <a href="" class="symbol symbol-50px">
                        <div class="symbol-label">
                            <img
                                src="'.url(Storage::url($category->image)).'"
                                alt="Hình ảnh" class="w-100"
                            />
                        </div>
                    </a>
                ';
            })
            ->addColumn('action', function ($category) {
                return '
                     <a href="'.route('admin.categories.edit', ['id' => $category->id]).'"
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
                        data-id="'.$category->id.'" data-token="{{csrf_token()}}"
                        tooltip="Xóa"
                        flow="up"
                        class="menu-link px-3 text-warning delete">
                        <i style="color:red" class="fa-solid fa-trash"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function ($category) {
                return '
                            <div >
                               '.date("H:i | d/m/Y", strtotime($category->created_at)).'
                            </div>';

            })
            ->rawColumns(['name', 'image', 'action', 'created_at'])
            ->make(true);

    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public  function store(Request $request)
    {
        $data = $request->all();
        $category = new Category;
        $category->name = $data['name'];
        $category->user_id = Auth::guard('admin')->id();
//        $category->user_id = 1;
        $category->description = $data['description'];
        if($request->hasFile('image')){
            $disk = 'public';
            $path = $request->file('image')->store('images', $disk);
            $category->image = $path;
        }
        $category->save();
        $request->session()->flash('success','Tạo danh mục mới thành công');
        return redirect()->route('admin.categories.index');
    }

    public  function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with([
            'category' => $category,
        ]);
    }

    public  function update(Request $request,$id)
    {
        $data = $request->all();
        $category = Category::findOrFail($id);
//        $category->user_id = 1;
        $category->name = $data['name'];
        $category->description = $data['description'];
        if($request->hasFile('image')){
            $disk = 'public';
            $path = $request->file('image')->store('images', $disk);
            $category->image = $path;
        };
        $category->update();
        $request->session()->flash('success', 'Cập nhật danh mục thành công');
        DB::commit();
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
            $check = Product::where('category_id', $id)->first();
            if(isset($check)){
                $check = true;
                return response()->json([
                    'error' => 'Không thể xóa',
                    'check' => $check
                ]);
            }else{
                Category::destroy($id);
                return response()->json(['success' => 'Thành công']);
            }
    }
}

