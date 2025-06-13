<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController
{
    public function index(){
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::where('status','5')->count(); 
        return view('admin.dashboard', compact('categories','products','orders'));
    }

    public function filterByDate(Request $request){

        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date,$to_date])->orderBy('created_at', 'ASC')->get();

        foreach ($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'revenue' => $value->revenue,
                'quantity' => $value->quantity,
                'profit' => $value->profit,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        // $data = $request->all();

        // $nsmonth = Carbon::now()->startOfMonth()->toDateString();
        // $lsmonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        // $llmonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        // $week = Carbon::now()->subDays(7)->toDateString();
        // $year = Carbon::now()->subDays(365)->toDateString();
        // $now = Carbon::now()->toDateString();

        // if ($data['dashboard_value'] == 'week'){
        //     $get = Statistic::whereBetween('order_date', [$week, $now])->orderBy('order_date','ASC')->get();
        // }elseif ($data['dashboard_value'] == 'month1'){
        //     $get = Statistic::whereBetween('order_date', [$lsmonth, $llmonth])->orderBy('order_date','ASC')->get();
        // }elseif ($data['dashboard_value'] == 'month2'){
        //     $get = Statistic::whereBetween('order_date', [$nsmonth, $now])->orderBy('order_date','ASC')->get();
        // }else{
        //     $get = Statistic::whereBetween('order_date', [$year, $now])->orderBy('order_date','ASC')->get();
        // // }

        // foreach ($get as $key => $value){
        //     $chart_data[] = array(
        //         'period' => $value->order_date,
        //         'order' => $value->total_order,
        //         'revenue' => $value->revenue,
        //         'quantity' => $value->quantity,
        //         'profit' => $value->profit,
        //     );
        // }

        // echo $data = json_encode($chart_data);
    }

}
