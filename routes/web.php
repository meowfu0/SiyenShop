<?php

use App\Http\Livewire\Admin\AdminChat;
use App\Http\Livewire\Admin\AdminFaqs;
use App\Http\Livewire\Admin\AdminFaqsDeleted;
use App\Http\Livewire\AdminShops;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\AdminUsers;
use App\Http\Livewire\Admin\AdminSidenav;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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


Auth::routes();

Route::get('/admin', function () {
    return redirect()->route('admin.faqs');
})->name('Admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');