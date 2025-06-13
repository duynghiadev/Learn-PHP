<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'image',
        'description',
        'user_id'
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute(){
        return url(\Illuminate\Support\Facades\Storage::url($this->image));
    }
}
