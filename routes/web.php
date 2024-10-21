<?php

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

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
    Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
    Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
    Route::get('/shops', [AdminShops::class, 'render'])->name('admin.shops');
    Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
    Route::get('/faqs/deleted', [AdminFaqsDeleted::class, 'render'])->name('admin.faqs-deleted');
    Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
});
Route::prefix('user')->group(function () {
    Route::get('/chat', [UserChat::class, 'render'])->name('user.chat');
    Route::get('/profile', [UserProfile::class, 'render'])->name('user.profile');
    Route::get('/sidenav', [UserSidenav::class, 'render'])->name('user.sidenav');
    Route::get('/my-purchases', [UserMyPurchases::class, 'render'])->name('user.my-purchases');
});


Auth::routes();

Route::get('/admin', function () {
    return redirect()->route('admin.faqs');
})->name('Admin');

Route::get('/user', function () {
    return redirect()->route('user.chat');
})->name('User');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');