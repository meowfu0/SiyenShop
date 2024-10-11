<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentPageController extends Controller
{
    public function index()
    {
        return view('Pages.paymentPage');
    }
  
}


