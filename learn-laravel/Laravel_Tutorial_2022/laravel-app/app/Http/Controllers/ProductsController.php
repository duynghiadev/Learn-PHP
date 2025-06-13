<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        // Define all variables to pass to the view
        $title = 'Laravel Course from Nguyen Duc Hoang';
        $x = 1;
        $y = 2;
        $name = 'Hoang';
        $myPhone = [
            'name' => 'iphone 14',
            'year' => 2022,
            'isFavorite' => true,
        ];
        $product = $myPhone;

        return view('products.index', compact('title', 'x', 'y', 'name', 'product'));
    }

    public function about()
    {
        return 'This is About page';
    }

    public function detail($productName, $id = null)
    {
        $phones = [
            'iphone15' => ['name' => 'iphone 15', 'year' => 2023, 'isFavorite' => false],
            'samsung' => ['name' => 'samsung', 'year' => 2023, 'isFavorite' => false]
        ];

        $product = $phones[$productName] ?? ['name' => 'unknown product', 'year' => null, 'isFavorite' => false];

        // Pass default values to avoid undefined variable errors in the view
        $title = 'Product Details';
        $x = 0;
        $y = 0;
        $name = 'Guest';

        return view('products.index', compact('title', 'x', 'y', 'name', 'product', 'productName', 'id'));
    }
}
