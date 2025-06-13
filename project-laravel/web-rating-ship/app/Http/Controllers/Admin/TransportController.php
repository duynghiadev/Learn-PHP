<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;
use App\Models\District;
use App\Models\City;
use App\Models\Transport;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::orderBy('matp','DESC')->get();
        return view('admin.transport.create',compact('city'));
    }
    public function update_delivery(Request $request){
		$data = $request->all();
		$fee_ship = Transport::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_ship = $fee_value;
		$fee_ship->save();
	}
    public function insert_delivery(Request $request){
		$data = $request->all();
		$fee_ship = new Transport();
		$fee_ship->transport_matp = $data['city'];
		$fee_ship->transport_maqh = $data['province'];
		$fee_ship->transport_maxaid = $data['wards'];
		$fee_ship->fee_ship = $data['fee_ship'];
		$fee_ship->save();
	}
    public function select_feeship(){
		$feeship = Transport::with('city','province','wards')->orderby('id','DESC')->get();
		$output = '';
		$output .= '<div class="table-responsive">  
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';

				foreach($feeship as $key => $fee){

				$output.='
					<tr>
						<td>'.$fee->city->name_city.'</td>
						<td>'.$fee->province->name_quanhuyen.'</td>
						<td>'.$fee->wards->name_xaphuong.'</td>
						<td contenteditable data-feeship_id="'.$fee->id.'" class="fee_feeship_edit">'.number_format($fee->fee_ship,0,',','.').'</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
				</table></div>
				';

				echo $output;

		
	}
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Ward::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
