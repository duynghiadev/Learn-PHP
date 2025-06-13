<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::orderBy('id', 'DESC')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $booking_existed = Booking::where('tour_id', $data['tour_code'])
            ->where('email', $data['email'])
            ->where('phone', $data['phone'])->first();
        if (!empty($booking_existed)) {
            toastr()->error('Tour này bạn đã đặt,vui lòng chờ hệ thống liên hệ hoặc đặt tour khác.', 'Error');
            return redirect()->back();
        }
        $booking = new Booking();
        $booking->tour_id = $data['tour_code'];
        $booking->date_departure = $data['date_departure'];
        $booking->fullname = $data['fullname'];
        $booking->email = $data['email'];
        $booking->note = $data['note'];
        $booking->phone = $data['phone'];
        $booking->adult = $data['adult'];

        $booking->children6_11 = $data['children6_11'];
        $booking->children2_5 = $data['children2_5'];
        $booking->children2 = $data['children_2'];

        $booking->save();
        toastr()->success('Đặt tour thành công,vui lòng chờ hệ thống liên hệ!', 'Đặt thành công');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        $tour = Tour::where('tour_code', $booking->tour_id)->first();
        return view('admin.bookings.show', compact('booking', 'tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
