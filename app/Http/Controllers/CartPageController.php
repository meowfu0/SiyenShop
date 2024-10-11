<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cartPageController extends Controller
{
    public function index()
    {
        return view('Pages.cartPage');
    }
  
}


