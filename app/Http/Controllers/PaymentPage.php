<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentPage extends Controller
{
    public function index()
    {
        return view ('paymentPage');
    }
}