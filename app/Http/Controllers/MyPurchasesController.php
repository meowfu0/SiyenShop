<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPurchasesController extends Controller
{
    public function index()
    {
        return view ('Pages.mypurchases');
    }
}
