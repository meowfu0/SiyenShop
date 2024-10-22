<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkOutPageController extends Controller
{
    public function index()
    {
        return view('user.checkOutPage');
    }
  
}


