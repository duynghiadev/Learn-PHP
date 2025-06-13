<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use Controller;

class RatingController extends Controller
{
    public function index($id)
    {
        // $rating = Rating::where('product_id', $id)->avg('rating');
        // $rating = round($rating);

    }
}
