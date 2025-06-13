<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trademark extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trademarks';
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute(){
        return url(\Illuminate\Support\Facades\Storage::url($this->image));
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
