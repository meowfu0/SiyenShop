<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class shopPageController extends Controller
{
    public function index()
    {
         // Fetch all the user rows from the database
         $shops = Shop::with(['user', 'course', 'status'])->get();
         return view('livewire.admin.admin-shops', compact('shops'));
    }
}

