<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'user_id', 'content', 'email','name','product_id'
    ];
 	protected $table = 'comments';
     public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
