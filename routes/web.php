<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


Route::get('/',[HomeController::class,'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix'=>'cart-items'],function(){
        Route::get('/',[CartController::class,'index'])->name('cartitems');
        Route::post('/',[CartController::class,'addCart'])->name('addcart');
        Route::post('/remove-cart',[CartController::class,'deletCartItem'])->name('delete.cartitem');
    });

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
