<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopPageController extends Controller
{
    public function index()
    {
        return view('pages.shopPage');
    }
}

