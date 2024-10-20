<?php

use App\Http\Livewire\ShopChat;
use App\Http\Livewire\ShopDashboard;
use App\Http\Livewire\ShopOrders;
use App\Http\Livewire\ShopProducts;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminUsers;
use App\Http\Livewire\Admin\AdminSidenav;
use App\Http\Livewire\Admin\AdminShops;
use App\Http\Livewire\Admin\AdminFaqs;
use App\Http\Livewire\Admin\AdminChat;
use App\Http\Livewire\Admin\CreateShop;
use App\Http\Livewire\Admin\Updateshop; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\shopPageController; // Use PascalCase
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductDetailswithSizeController;


/*
|------------------s--------------------------------------------------------
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
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('Admin');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
    Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
    Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
    Route::get('/shops', [AdminShops::class, 'render'])->name('admin.shops');
    Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
    Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
    Route::prefix('shops')->group(function () {
        Route::get('/create', [CreateShop::class, 'render'])->name('admin.createshop');
        Route::get('/update', [Updateshop::class, 'render'])->name('admin.updateshop');
    });
});


Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/shopPage', [shopPageController::class, 'index'])->name('shopPage');
Route::get('/productDetails', [ProductDetailsController::class, 'index'])->name('productDetails');
Route::get('/productDetailswithSize', [ProductDetailswithSizeController::class, 'index'])->name('productDetailswithSize');
Route::get('/customerReview', [CustomerReviewController::class, 'index'])->name('customerReview');
