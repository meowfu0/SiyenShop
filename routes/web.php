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

use App\Http\Livewire\Admin\AdminChat;
use App\Http\Livewire\Admin\AdminFaqs;
use App\Http\Livewire\Admin\AdminFaqsDeleted;
use App\Http\Livewire\AdminShops;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\AdminUsers;
use App\Http\Livewire\Admin\AdminSidenav;
use App\Http\Livewire\UserChat;
use App\Http\Livewire\UserMyPurchases;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\UserSidenav;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/faqs', function () {
    return view('customer_support/faqs');
});
Route::get('/chat', function () {
    return view('customer_support/chat');
});
Route::get('/admin/chat', function () {
    return view('customer_support/admin_chat');
});
Route::get('/busmngr/chat', function () {
    return view('customer_support/busmngr_chat');
});
Route::get('/userprofile', function () {
    return view('userprofile');
});


Auth::routes();

Route::get('/admin', function () {
    return redirect()->route('admin.faqs');
})->name('Admin');

Route::get('/user', function () {
    return redirect()->route('user.chat');
})->name('User');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/busmngr', [App\Http\Controllers\BusmngrController::class, 'index'])->name('busmngr');
