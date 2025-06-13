<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Tour;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Find the existing schedule by tour_id
        $schedule = Schedule::where('tour_id', $request->tour_id)->first();

        if ($schedule) {
            // If exists, update the schedule
            $schedule->lichtrinh = $request->lichtrinh;
            $schedule->chinhsach = $request->chinhsach;
            $schedule->baogom = $request->baogom;
            $schedule->khongbaogom = $request->khongbaogom;
            $schedule->save();
            toastr()->success('Cập nhật lịch trình chính sách tour thành công.', 'Updated');
        } else {
            // If not exists, create a new schedule
            $schedule = new Schedule();
            $schedule->tour_id = $request->tour_id;
            $schedule->lichtrinh = $request->lichtrinh;
            $schedule->chinhsach = $request->chinhsach;
            $schedule->baogom = $request->baogom;
            $schedule->khongbaogom = $request->khongbaogom;
            $schedule->save();

            toastr()->success('Thêm lịch trình chính sách tour thành công.', 'Created');
        }

        return redirect()->back();
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
        $schedule = Schedule::where('tour_id', $id)->first();
        $tour = Tour::find($id);
        return view('admin.schedules.create', compact('tour', 'schedule'));
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
