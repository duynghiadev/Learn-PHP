<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = $this->getCategoriesProduct();
        // dd($categories);
        return view('admin.categories.create', compact('categories'));
    }
    public function getCategoriesProduct()
    {
        $categories = Category::orderBy('category_parent', 'DESC')->get();
        $listCategory = [];
        Category::recursive($categories, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:categories|max:255',
                'description' => 'required|max:220',
                'image' => 'required',
                'status' => 'required',
                'category_parent' => 'required',
            ],
            [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'description.required' => 'Yêu cầu nhập mô tả',
                'image.required' => 'Yêu cầu nhập hình ảnh',
                'status.required' => 'Yêu cầu check status',
                'title.unique' => 'Tiêu đề đã có vui lòng nhập không trùng',
            ]
        );
        $category = new Category();
        $category->title = $data['title'];
        $category->category_parent = $data['category_parent'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/categories/';
        $get_name_image = $get_image->getClientOriginalName(); //hinh544.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image =  $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;

        $category->save();
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $categories = $this->getCategoriesProduct();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required|max:220',
                'category_parent' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'description.required' => 'Yêu cầu nhập mô tả',

                'status.required' => 'Yêu cầu check status',
                'title.unique' => 'Tiêu đề đã có vui lòng nhập không trùng',
            ]
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->category_parent = $data['category_parent'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);
        //them anh vao folder hinh188.jpg
        if ($request->image) {
            $get_image = $request->image;
            $path = 'uploads/categories/';
            $get_name_image = $get_image->getClientOriginalName(); //hinh544.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $category->image = $new_image;
        }
        toastr()->success('Data has been saved successfully!', 'Congrats');
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        //$categories->delete();
        return redirect()->route('categories.index');
    }
}
