<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductDetailswithSizeController extends Controller
{
    public function index()
    {
        return view('user.productDetailswithSize');
    }
}
