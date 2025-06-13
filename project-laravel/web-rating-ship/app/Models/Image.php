<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'path',
        'product_id'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url(Storage::url($this->path));
    }
}
