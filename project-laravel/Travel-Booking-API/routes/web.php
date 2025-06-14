<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;
use App\Models\Backlog;
use App\Models\Employee;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::resource('destinations', DestinationController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('users', UserController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('backlogs', BacklogController::class);
});
