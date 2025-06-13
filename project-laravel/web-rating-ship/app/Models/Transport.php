<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'city', 'province','wards','fee_ship'
    ];
 	protected $table = 'transport';
    public function city(){

        return $this->belongsTo(City::class,'transport_matp');
    }
    public function province(){
        return $this->belongsTo(District::class, 'transport_maqh');
    }
    public function wards(){
        return $this->belongsTo(Ward::class, 'transport_xaid');
    }
}
