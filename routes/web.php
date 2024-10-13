<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/chat', function () {
    return view('customer_support/chat');
});
Route::get('/admin/chat', function () {
    return view('customer_support/admin_chat');
});

Route::get('/userprofile', function () {
    return view('userprofile');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('customer_support/home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
