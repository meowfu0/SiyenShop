<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopPage extends Controller
{
    public function index()
    {
        return view ('shopPage');
    }
}
