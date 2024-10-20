<?php

use App\Http\Livewire\ShopChat;
use App\Http\Livewire\ShopSidenav;
use App\Http\Livewire\ShopOrders;
use App\Http\Livewire\ShopProducts;
use App\Http\Livewire\ShopDashboard;
use App\Http\Livewire\Admin\AdminChat;
use App\Http\Livewire\Admin\AdminFaqs;
use App\Http\Livewire\Admin\AdminShops;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminUsers;
use App\Http\Livewire\Admin\AdminSidenav;

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

Route::get('/shop', function () {
    return redirect()->route('shop.dashboard');
})->name('Shop');

Route::prefix('shop')->group(function () {
    Route::get('/chat', [ShopChat::class, 'render'])->name('shop.chat');
    Route::get('/dashboard', [ShopDashboard::class, 'render'])->name('shop.dashboard');
    Route::get('/products', [ShopProducts::class, 'render'])->name('shop.products');
    Route::get('/orders', [ShopOrders::class, 'render'])->name('shop.orders');
    Route::get('/sidenav', [ShopSidenav::class, 'render'])->name('shop.sidenav');

});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
    Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
    Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
    Route::get('/shops', [AdminShops::class, 'render'])->name('admin.shops');
    Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
    Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('Admin');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('customer_support/home');

