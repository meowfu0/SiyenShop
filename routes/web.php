<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/faqs', function () {
    return view('customer_support/faqs');
});
Route::get('/userprofile', function () {
    return view('userprofile');
});


Auth::routes();

Route::get('/admin', function () {
    return redirect()->route('admin.faqs');
})->name('Admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/faqs', function () {
    return view('customer_support/faqs');
});