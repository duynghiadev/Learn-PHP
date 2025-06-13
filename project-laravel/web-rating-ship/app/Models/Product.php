<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'origin_price',
        'sale_price',
        'category_id',
        'trademark_id',
        'user_id',
        'sold',
        'status',
    ];

    protected $appends = ['status_text'];

    const STATUS_INIT = 0;
    const STATUS_BUY = 1;
    const STATUS_STOP = 2;

    public static $status_text = [
        self::STATUS_INIT => 'Đang nhập',
        self::STATUS_BUY => 'Đang bán',
        self::STATUS_STOP => 'Dừng bán'
    ];

    public function getStatusTextAttribute()
    {
        if ($this->status == 0) {
            return 'Đang nhập';
        } elseif ($this->status == 1) {
            return 'Đang bán';
        } else {
            return 'Dừng bán';
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function trademark()
    {
        return $this->belongsTo(trademark::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
