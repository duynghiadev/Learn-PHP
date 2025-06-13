<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Trademark;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;


class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function getlist(Request $request)
    {
        $products = Product::with(['category', 'images'])->orderBy('created_at', 'DESC')->get();

        return Datatables::of($products)->addIndexColumn()
            ->editColumn('name', function ($product) {
                return '<a href=""><b>' . $product->name . '</b></a>';
            })
            ->editColumn('category_id', function ($product) {
                return  $product->category ? $product->category->name : "";
            })
            ->editColumn('trademark_id', function ($product) {
                return  $product->trademark ? $product->trademark->name : "";
            })
            ->editColumn('quantity', function ($product) {
                return  $product->quantity;
            })
            ->editColumn('image', function ($product) {
                return '
                    <a href="" class="symbol symbol-50px">
                        <div class="symbol-label">
                            <img
                                src="' . $product->images[0]->image_url . '"
                                alt="Hình ảnh" class="w-100"
                            />
                        </div>
                    </a>
                ';
            })
            ->addColumn('action', function ($product) {
                return '
                     <a href="' . route('admin.products.edit', ['id' => $product->id]) . '"
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
                        data-id="' . $product->id . '" data-token="{{csrf_token()}}"
                        tooltip="Xóa"
                        flow="up"
                        class="menu-link px-3 text-warning delete">
                        <i style="color:red" class="fa-solid fa-trash"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function ($product) {
                return '
                            <div >
                               ' . date("H:i | d/m/Y", strtotime($product->created_at)) . '
                            </div>';
            })
            ->rawColumns(['name', 'category_id', 'trademark_id', 'quantity', 'image', 'action', 'created_at'])
            ->make(true);
    }

    public function create()
    {
        $categories = Category::get();
        $trademarks = Trademark::get();
        return view('admin.products.create')->with([
            'categories' => $categories,
            'trademarks' => $trademarks
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->user_id = Auth::guard('admin')->id();
        //        $product->user_id = 1;
        $product->description = $data['description'];
        $product->quantity = $data['quantity'];
        $product->origin_price = $data['origin_price'];
        $product->sale_price = $data['sale_price'];
        $product->category_id = $data['category_id'];
        $product->trademark_id = $data['trademark_id'];
        $product->status = $data['status'];
        $product->save();

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {
                $name = $file->getClientOriginalName(); //lay tèn file
                $disk = 'public';
                $path = Storage::disk($disk)->put('images/products/' . $name, file_get_contents($file));

                $image = new Image();
                $image->name = $name;
                $image->path = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        $request->session()->flash('success', 'Tạo sản phẩm mới thành công');
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with(['category', 'images'])->first();
        $categories = Category::get();

        $trademarks = Trademark::get();
        return view('admin.products.edit')->with([
            'categories' => $categories,
            'product' => $product,
            'trademarks' => $trademarks
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);
        $product->name = $data['name'];
        $product->user_id = Auth::guard('admin')->user()->id;
        $product->description = $data['description'];
        $product->quantity = $data['quantity'];
        $product->origin_price = $data['origin_price'];
        $product->sale_price = $data['sale_price'];
        $product->category_id = $data['category_id'];
        $product->trademark_id = $data['trademark_id'];
        $product->status = $data['status'];
        $product->save();

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $disk = 'public';
                $path = Storage::disk($disk)->put('images/products/' . $name, file_get_contents($file));

                $image = new Image();
                $image->name = $name;
                $image->path = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        $request->session()->flash('success', 'Cập nhật sản phẩm thành công');
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json([
            'success' => 'Record has been deleted successfully!',
            'status' => 200
        ]);
    }
}
