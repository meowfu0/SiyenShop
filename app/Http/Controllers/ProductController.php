<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * This supports the ShopProducts Livewire component.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop-products'); // Blade for ShopProducts Livewire component
    }

    /**
     * Show the form for creating a new resource.
     * This supports the ShopProductsAdd Livewire component.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop-products-add'); // Blade for ShopProductsAdd Livewire component
    }

    /**
     * Show the form for editing the specified resource.
     * This supports the ShopProductsEdit Livewire component.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('shop-products-edit', compact('product')); // Blade for ShopProductsEdit Livewire component
    }

    /**
     * Display deleted products (for history).
     * This supports the ShopProductsHistory Livewire component.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        return view('shop-products-history'); // Blade for ShopProductsHistory Livewire component
    }
}
