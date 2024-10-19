<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    public function index()
    {
        return view('pages.customerReview');
    }
}

