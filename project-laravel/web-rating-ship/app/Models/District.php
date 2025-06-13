<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_quanhuyen', 'type','matp'
    ];
 	protected $table = 'quanhuyen';
    protected $primaryKey = 'maqh';
}
