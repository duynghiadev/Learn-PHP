<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use Str;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with('category')->orderby('id', 'DESC')->get();
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:tours|max:255',
                'description' => 'required|max:220',
                'quantity' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'vehicle' => 'required',
                'departure_date' => 'required',
                'return_date' => 'required',
                'tour_from' => 'required',
                'tour_to' => 'required',
                'tour_time' => 'required',
                'image' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã có vui lòng nhập không trùng',

                'description.required' => 'Yêu cầu nhập mô tả',
                'quantity.required' => 'Yêu cầu nhập số lượng',
                'price.required' => 'Yêu cầu nhập giá',
                'vehicle.required' => 'Yêu cầu nhập phương tiện',
                'departure_date.required' => 'Yêu cầu nhập ngày đi',
                'return_date.required' => 'Yêu cầu nhập ngày về',
                'tour_from.required' => 'Yêu cầu nhập nơi đi',
                'tour_to.required' => 'Yêu cầu nhập nơi đến',
                'tour_time.required' => 'Yêu cầu nhập thời gian tour',
                'image.required' => 'Yêu cầu nhập hình ảnh',
                'status.required' => 'Yêu cầu check status',

            ]
        );
        $tour = new Tour();
        $tour->title = $data['title'];
        $tour->description = $data['description'];
        $tour->quantity = $data['quantity'];
        $tour->price = $data['price'];
        $tour->category_id = $data['category_id'];
        $tour->vehicle = $data['vehicle'];
        $tour->departure_date = json_encode($data['departure_date']);
        $tour->return_date = $data['return_date'];
        $tour->tour_from = $data['tour_from'];
        $tour->tour_to = $data['tour_to'];
        $tour->tour_time = $data['tour_time'];
        $tour->status = $data['status'];
        $tour->slug = Str::slug($data['title']);
        $tour->tour_code = rand(0000, 9999);

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/tours/';
        $get_name_image = $get_image->getClientOriginalName(); //hinh544.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image =  $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $tour->image = $new_image;

        $tour->save();
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('tours.index');
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
        $categories = Category::orderBy('id', 'DESC')->get();
        $tour = Tour::find($id);
        return view('admin.tours.edit', compact('tour', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:tours|max:255',
                'description' => 'required|max:220',
                'quantity' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'vehicle' => 'required',
                'departure_date' => 'required',
                'return_date' => 'required',
                'tour_from' => 'required',
                'tour_to' => 'required',
                'tour_time' => 'required',

                'status' => 'required',
            ],
            [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã có vui lòng nhập không trùng',

                'description.required' => 'Yêu cầu nhập mô tả',
                'quantity.required' => 'Yêu cầu nhập số lượng',
                'price.required' => 'Yêu cầu nhập giá',
                'vehicle.required' => 'Yêu cầu nhập phương tiện',
                'departure_date.required' => 'Yêu cầu nhập ngày đi',
                'return_date.required' => 'Yêu cầu nhập ngày về',
                'tour_from.required' => 'Yêu cầu nhập nơi đi',
                'tour_to.required' => 'Yêu cầu nhập nơi đến',
                'tour_time.required' => 'Yêu cầu nhập thời gian tour',

                'status.required' => 'Yêu cầu check status',

            ]
        );
        $tour = Tour::find($id);
        $tour->title = $data['title'];
        $tour->description = $data['description'];
        $tour->quantity = $data['quantity'];
        $tour->price = $data['price'];
        $tour->vehicle = $data['vehicle'];
        $tour->category_id = $data['category_id'];
        $tour->departure_date = $data['departure_date'];
        $tour->return_date = $data['return_date'];
        $tour->tour_from = $data['tour_from'];
        $tour->tour_to = $data['tour_to'];
        $tour->tour_time = $data['tour_time'];
        $tour->status = $data['status'];
        $tour->slug = Str::slug($data['title']);
        $tour->tour_code = $tour->tour_code;

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        if ($get_image) {
            $path = 'uploads/tours/';
            $get_name_image = $get_image->getClientOriginalName(); //hinh544.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $tour->image = $new_image;
        }
        $tour->save();
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('tours.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tour::find($id)->delete();
        toastr()->success('Data has been deleted successfully!', 'Congrats');
        return redirect()->route('tours.index');
    }
}
