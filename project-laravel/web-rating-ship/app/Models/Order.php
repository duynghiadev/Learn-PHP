<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status',
        'total',
        'customer_id',
        'product_id',
        'payment_type',
        'update_by',
        'note',
    ];

    protected $appends = ['status_text','payment_text'];

    const WAIT = 0;
    const CONFIRM = 1;
    const REQUESTCANEL = 2;
    const CANCEL = 3;
    const SHIPPING = 4;
    const COMPLETE = 5;
    // const REFUND = 6;

    const CASH = 0;
    const TRANSFER = 1;

    public $statusArr = [
        self::WAIT => 'Chờ xác nhận',
        self::CONFIRM => 'Đã xác nhận',
        self::REQUESTCANEL => 'Yêu cầu huỷ',
        self::CANCEL => 'Đã hủy',
        self::SHIPPING => 'Đang giao',
        self::COMPLETE => 'Đã giao',
        // self::COMPLETE => 'Hoàn hàng',
    ];

    public $typePaymentArr = [
        self::TRANSFER => 'Thanh toán qua VNPAY',
        self::CASH => 'Thanh toán khi nhận hàng',
    ];

    
    public function getStatusTextAttribute(){
        return $this->statusArr [$this->status];
    }

    public function getPaymentTextAttribute(){
        return $this->typePaymentArr[$this->payment_type];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'update_by');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderProduct::class)->with('product');
    }
}
