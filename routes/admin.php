<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminLoginController::class, 'index']);
Route::post('/', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['adminauth', 'auth:admin']], function () {

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('getData', [ProductController::class, 'getData'])->name('service.getData');
        Route::post('/', [ProductController::class, 'addService'])->name('service.add');
        Route::post('change-status', [ProductController::class, 'changeStatus'])->name('service.statuschange');
        Route::get('/{id}', [ProductController::class, 'getServiceById'])->name('service.get');
        Route::delete('/{id}', [ProductController::class, 'delete'])->name('service.delete');
    });

});


// Admin

// 1. Login
// 2. Product Management
//        Category
//         Multiple image upload for each product
// 3. Stock Listing
// 4. Cart product listing

// Frontend

// 1. Customer registration
// 2. Login
// 3. Product Listing
//           Category filter
// 4. Add to cart
//          purchase flow up to cart list
