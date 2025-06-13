<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tour_price';
}
