<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orderSummaryPageController extends Controller
{
    public function index()
    {
        return view('user.orderSummaryPage');
    }
  
}


