<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailswithSizeController extends Controller
{
    /**
     * Display the product details with size options page.
     * This supports the ProductDetailswithSize Livewire component.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.productDetailswithSize'); // Blade for ProductDetailswithSize Livewire component
    }

    /**
     * Show the details of a specific product with size options.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('user.product-details-with-size', compact('product')); // View to show details of a product with size options
    }
}
