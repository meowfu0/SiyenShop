<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cartPageController; 
use App\Http\Controllers\checkOutPageController;
use App\Http\Controllers\paymentPageController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cartPage', [cartPageController::class, 'index'])->name('cartPage');
Route::get('/checkOutPage', [checkOutPageController::class, 'index'])->name('checkOutPage');
Route::get('/paymentPage', [paymentPageController::class, 'index'])->name('paymentPage');



