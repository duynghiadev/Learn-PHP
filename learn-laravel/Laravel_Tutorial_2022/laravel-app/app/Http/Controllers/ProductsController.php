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
        // Pass $myPhone as $product to match the view's expectation
        $product = $myPhone;

        // Return the view with all variables
        return view('products.index', compact('title', 'x', 'y', 'name', 'product'));
    }

    public function about()
    {
        return 'This is About page';
    }

    public function detail($productName, $id)
    {
        $phones = [
            'iphone 15' => 'iphone 15',
            'samsung' => 'samsung'
        ];

        $product = $phones[$productName] ?? 'unknown product';

        return view('products.index', [
            'product' => $product,
            'productName' => $productName,
            'id' => $id
        ]);
    }
}
