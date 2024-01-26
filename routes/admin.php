<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CartAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminLoginController::class, 'index']);
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['adminauth', 'auth:admin']], function () {

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('getData', [ProductController::class, 'getData'])->name('product.getData');
        Route::post('/', [ProductController::class, 'addProduct'])->name('product.add');
        Route::get('/{id}', [ProductController::class, 'getProductById'])->name('product.get');
        Route::delete('/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('/product-image',[ProductController::class,'deleteImage'])->name('product.delete.productimage');
    });

    Route::group(['prefix'=>'category'],function(){
        Route::get('/',[CategoryController::class,'index'])->name('category');
        Route::get('/getData',[CategoryController::class,'getData'])->name('category.getData');
        Route::post('/',[CategoryController::class,'addCategory'])->name('category.add');
        Route::get('/{id}',[CategoryController::class,'getCategory'])->name('category.get');
        Route::delete('/{id}',[CategoryController::class,'deleteCategory'])->name('category.delete');

    });

    Route::group(['prefix'=>'stocks'],function(){
        Route::get('/',[StockController::class,'index'])->name('stocks');
        Route::get('/getData',[StockController::class,'getData'])->name('stock.getData');
        Route::post('/',[StockController::class,'updateStock'])->name('stock.manage');
    });

    Route::group(['prefix'=>'carts'],function(){
        Route::get('/',[CartAdminController::class,'index'])->name('carts');
        Route::get('/getData',[CartAdminController::class,'getData'])->name('cartitem.getData');
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
