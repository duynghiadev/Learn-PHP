<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\OrderController as UserOrder;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Admin\TrademarkController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\TransportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth - Đăng nhập, đăng ký
//Auth Admin
Route::get('/admin/login', [LoginController::class, 'showLoginFormAdmin'])->name('login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/admin/logout', [LogoutController::class,'logoutAdmin'])->name('logout');

//Auth User
Route::get('/login', [LoginController::class,'showLoginForm'])->name('user.login.form');
Route::post('/login', [LoginController::class,'loginUser'])->name('user.login.store');
Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('user.register.form');
Route::post('/register', [RegisterController::class,'register'])->name('user.register.store');
Route::get('/logout', [LogoutController::class,'logoutUser'])->name('user.logout');
//Rating & Comment
Route::post('/insert-rating',[HomeController::class,'insert_rating'])->name('insert-rating');
Route::post('/comment-product',[HomeController::class,'comment_product'])->name('comment-product');

//Admin - Trang quản lý
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['admin'],
], function () {
    //Trang điều khiển
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard');
    
    //Thống kê dashboard
    Route::get('/filter-by-date',  [DashboardController::class, 'filterByDate']);
    Route::get('/dashboard-filter',  [DashboardController::class, 'dashboard_filter']);

    // Quản lý người dùng
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/get-list', [UserController::class, 'getList'])->name('admin.users.getList');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}',[UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}',[UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/reset-password/{id}',[UserController::class,'resetPassword'])->name('admin.users.reset');
        Route::put('/lock/{id}', [UserController::class,'lock'])->name('admin.users.lock');
    });

    // Quản lý khách hàng
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/get-list', [CustomerController::class, 'getList'])->name('admin.customers.getList');
        Route::post('/reset-password/{id}',[CustomerController::class,'resetPassword'])->name('admin.customers.reset');
        Route::put('/lock/{id}', [CustomerController::class,'lock'])->name('admin.customers.lock');
    });

    // Quản lý danh mục
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/get-list', [CategoryController::class, 'getList'])->name('admin.categories.getList');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{id}',[CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{id}',[CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    // Quản lý sản phẩm
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/get-list', [ProductController::class, 'getList'])->name('admin.products.getList');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{id}',[ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{id}',[ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    //Quản lý thương hiệu
    Route::group(['prefix' => 'trademarks'], function () {
        Route::get('/', [TrademarkController::class, 'index'])->name('admin.trademarks.index');
        Route::get('/get-list', [TrademarkController::class, 'getList'])->name('admin.trademarks.getList');
        Route::get('/create', [TrademarkController::class, 'create'])->name('admin.trademarks.create');
        Route::post('/', [TrademarkController::class, 'store'])->name('admin.trademarks.store');
        Route::get('/edit/{id}', [TrademarkController::class, 'edit'])->name('admin.trademarks.edit');
        Route::put('/{id}',[TrademarkController::class, 'update'])->name('admin.trademarks.update');
        Route::delete('/{id}',[TrademarkController::class, 'destroy'])->name('admin.trademarks.destroy');
    });

    //Quản lý mã giảm giá
    Route::group(['prefix' => 'coupons'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('admin.coupon.index');
        Route::get('/get-list', [CouponController::class, 'getList'])->name('admin.coupon.getList');
        Route::get('/create', [CouponController::class, 'create'])->name('admin.coupon.create');
        Route::post('/', [CouponController::class, 'store'])->name('admin.coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
        Route::put('/{id}',[CouponController::class, 'update'])->name('admin.coupon.update');
        Route::delete('/{id}',[CouponController::class, 'destroy'])->name('admin.coupon.destroy');
    });

    // Quản lý đơn hàng
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/get-list', [OrderController::class, 'getList'])->name('admin.orders.getList');
        Route::post('/change-status/{id}', [OrderController::class, 'changeStatus'])->name('admin.orders.changeStatus');
    });
    // Quản lý comment
    Route::group(['prefix' => 'comment'], function () {
        Route::get('/', [CommentController::class, 'index'])->name('admin.comment.index');
    });
    // Quản lý vận chuyển
    Route::group(['prefix' => 'transport'], function () {
        Route::get('/', [TransportController::class, 'index'])->name('admin.transport.index'); 
        Route::get('/create', [TransportController::class, 'create'])->name('admin.transport.create'); 
        Route::post('/select-delivery', [TransportController::class, 'select_delivery'])->name('admin.transport.select-delivery'); 
        Route::post('/insert-delivery', [TransportController::class, 'insert_delivery'])->name('admin.transport.insert-delivery'); 
        Route::post('/select-feeship', [TransportController::class, 'select_feeship'])->name('admin.transport.select-feeship'); 
        Route::post('/update-delivery', [TransportController::class, 'update_delivery'])->name('admin.transport.update-delivery'); 
        
    });

    //Quản lý thông kê
    // Route::group(['prefix' => 'statisticals'], function(){
    //     Route::get('/', 'StatisticalController@index');
    //     // ->name('backend.statistical.index');
    //     Route::post('/filterByDate', 'StatisticalController@filterByDate');
    //     // ->name('backend.statistical.filterByDate');
    //     Route::post('/dayOrder', 'StatisticalController@dayOrder');
    //     // ->name('backend.statistical.dayOrder');
    //     Route::post('/filterAll', 'StatisticalController@filterAll');
    //     // ->name('backend.statistical.filterAll');
    // });

});


// User - Trang bán hàng
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/list-products', [HomeController::class,'listProduct'])->name('home.listProduct');
    Route::get('/search', [HomeController::class,'search'])->name('home.search');
    Route::get('/show/{id}', [HomeController::class,'show'])->name('home.show');

    //Liên hệ 
    Route::get('/contact', [ContactController::class,'showContact'])->name('home.contact');
    Route::post('/saveContact', [ContactController::class, 'save'])->name('home.contact.save');
    
    Route::group([
        'namespace' => 'User',
        'prefix' => '/',
        'middleware' => ['auth'],
], function () {
    Route::get('/add-card/{id}', [HomeController::class,'addToCard'])->name('home.addToCard');

    Route::get('/checkout', [HomeController::class,'checkout'])->name('home.checkout');

    //thanh toán online
    Route::post('/order/store', [PaymentController::class, 'store'])->name('home.order');
    Route::get('/order/return', [PaymentController::class, 'return']);
    

    Route::get('/account', [AccountController::class,'index'])->name('home.account');

    Route::post('/request-cancel/{id}', [UserOrder::class,'cancelOrder'])->name('home.cancelOrder');
    Route::post('/undo-cancel/{id}', [UserOrder::class,'undoCancel'])->name('home.undoCancel');

    //Coupon
    Route::post('check_coupon', [CartController::class, 'checkcoupon'])->name('user.product.checkcoupon');

    //Giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('user.product.cart');
    Route::get('/product/cart/add/{id}', [CartController::class, 'add'])->name('user.product.add');
    Route::get('/product/cart/remove/{id?}', [CartController::class, 'remove'])->name('user.product.remove');
    Route::get('/product/cart/destroy', [CartController::class, 'destroy'])->name('user.product.destroy');
    Route::get('/product/cart/increment/{id}', [CartController::class, 'increment'])->name('user.product.increment');
    Route::get('/product/cart/decrement/{id}', [CartController::class, 'decrement'])->name('user.product.decrement');

    //Đánh giá sản phẩm
    
});



