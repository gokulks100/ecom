<?php

use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminLoginController::class, 'index']);
Route::post('/', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


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
