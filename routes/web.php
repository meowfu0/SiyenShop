<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD


=======
use App\Http\Controllers\shopPage;
>>>>>>> 025361c332b2cb5e7fb460983529dba163dd5755
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

<<<<<<< HEAD
use App\Http\Controllers\shopPageController; // Use PascalCase

Route::get('/shopPage', [shopPageController::class, 'index'])->name('shopPage');




=======
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::get('/', function() {
    return view ('shopPage');
});*/


Route::get('/shopPage', [shopPage::class, 'index'])->name('shopPage');
>>>>>>> 025361c332b2cb5e7fb460983529dba163dd5755
