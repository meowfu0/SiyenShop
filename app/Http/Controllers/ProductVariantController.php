<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the product variants.
     * This could be used to list all variants of a product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productVariants = ProductVariant::all(); // Fetch all product variants
        return view('product-variants.index', compact('productVariants')); // Blade view for displaying all variants
    }

    /**
     * Show the form for creating a new product variant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all(); // Fetch all products to associate with variants
        return view('product-variants.create', compact('products')); // Blade for creating a new product variant
    }

    /**
     * Store a newly created product variant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product exists
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size' => 'nullable|string|max:100', // Example variant attribute
            'color' => 'nullable|string|max:100', // Example variant attribute
        ]);

        // Store the new product variant
        ProductVariant::create([
            'product_id' => $request->product_id,
            'variant_name' => $request->variant_name,
            'price' => $request->price,
            'size' => $request->size,
            'color' => $request->color,
        ]);

        return redirect()->route('product-variants.index')->with('success', 'Product Variant created successfully');
    }

    /**
     * Display the specified product variant.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        return view('product-variants.show', compact('productVariant')); // Blade to show a specific product variant
    }

    /**
     * Show the form for editing the specified product variant.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $productVariant)
    {
        $products = Product::all(); // Fetch all products to update the variant's product relation
        return view('product-variants.edit', compact('productVariant', 'products')); // Blade for editing product variant
    }

    /**
     * Update the specified product variant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product exists
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:100',
        ]);

        // Update the product variant
        $productVariant->update([
            'product_id' => $request->product_id,
            'variant_name' => $request->variant_name,
            'price' => $request->price,
            'size' => $request->size,
            'color' => $request->color,
        ]);

        return redirect()->route('product-variants.index')->with('success', 'Product Variant updated successfully');
    }

    /**
     * Remove the specified product variant from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $productVariant)
    {
        $productVariant->delete();

        return redirect()->route('product-variants.index')->with('success', 'Product Variant deleted successfully');
    }
}
