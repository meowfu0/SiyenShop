<?php

use App\Http\Livewire\UserChat;
use App\Http\Livewire\UserMyPurchases;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\UserSidenav;
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
Route::get('/faqs', function () {
    return view('customer_support/faqs');
});

Route::get('/user', function () {
    return redirect()->route('user.chat');
})->name('User');

Route::prefix('user')->group(function () {
    Route::get('/chat', [UserChat::class, 'render'])->name('user.chat');
    Route::get('/profile', [UserProfile::class, 'render'])->name('user.profile');
    Route::get('/sidenav', [UserSidenav::class, 'render'])->name('user.sidenav');
    Route::get('/my-purchases', [UserMyPurchases::class, 'render'])->name('user.my-purchases');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


