<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    /**
     * Display the product details page.
     * This supports the ProductDetails Livewire component.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.productDetails'); // Blade for ProductDetails Livewire component
    }

    /**
     * Show the details of a specific product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('user.product-details', compact('product')); // View to show details of a product
    }
}
