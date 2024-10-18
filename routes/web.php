<?php

use App\Http\Livewire\ShopChat;
use App\Http\Livewire\ShopDashboard;
use App\Http\Livewire\ShopOrders;
use App\Http\Livewire\ShopProducts;
use App\Http\Livewire\ShopProductsAdd;
use App\Http\Livewire\ShopProductsEdit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Shop Routes Group
//add middleware for authenticatio'n purposes
Route::get('/shop', function () {
    return redirect()->route('shop.dashboard');
})->name('Shop');

Route::prefix('shop')->group(function () {
    Route::get('/dashboard', [ShopDashboard::class, 'render'])->name('shop.dashboard');
    Route::get('/products', [ShopProducts::class, 'render'])->name('shop.products');
    Route::get('/orders', [ShopOrders::class, 'render'])->name('shop.orders');
    Route::get('/chat', [ShopChat::class, 'render'])->name('shop.chat');

    Route::get('/products/add', [ShopProductsAdd::class, 'render'])->name('shop.products.add');
    Route::get('/products/edit', [ShopProductsEdit::class, 'render'])->name('shop.products.edit');

});

