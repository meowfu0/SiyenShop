<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class shopPageController extends Controller
{
    public function index(Request $request)
    {
       
       
    $organization = $request->get('shop_id', 'All');
    $category = $request->get('category_id', 'All');

    $query = Product::query();

    if ($organization !== 'All') {
        $query->where('shop_id', $organization);
    }

    if ($category !== 'All') {
        $query->where('category_id', $category); 
    }

    $products = $query->get();


    return view('user.shopPage', compact('products'));


    }
}

