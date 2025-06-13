<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FoodsController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PagesController::class, 'index'])->name('home');

Route::get('/about', [PagesController::class, 'about']);
Route::get('/posts', [PostsController::class, 'index']);
Auth::routes();
Route::resource('foods', FoodsController::class);

Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Route for product details with productName and id
Route::get('/products/{productName}/{id}', [ProductsController::class, 'detail'])
    ->where([
        'productName' => '[a-zA-Z0-9\s]+',
        'id' => '[0-9]+'
    ])->name('products.detail');

// Route for products/about
Route::get('/products/about', [ProductsController::class, 'about'])->name('products.about');

// Route for users
Route::get('/users', function () {
    return 'This is the users page';
});

// Route for aboutMe
Route::get('/aboutMe', function () {
    return response()->json([
        'name' => 'Nguyen Duc Hoang',
        'email' => 'sunlight4d@gmail.com'
    ]);
});

// Route for something (redirect to foods)
Route::get('/something', function () {
    return redirect('/foods');
});
