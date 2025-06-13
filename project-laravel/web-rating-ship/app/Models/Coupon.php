<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'coupons';
    protected $appends = ['type'];
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_times',
        'coupon_condition',
        'coupon_number',
        'start_time',
        'end_time'
    ];

    const TYPE = [
        'PERCENT' => 1,
        'MONEY' => 2
    ];

    public function getTypeAttribute()
    {
        if($this->coupon_condition == self::TYPE['PERCENT']){
            $type = 'Giảm theo phần trăm';
        } else{
            $type = 'Giảm theo tiền mặt';
        }
        return $type;
    }
}
