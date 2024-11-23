<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ShopProducts extends Component
{
    public $products = [];

    public function render()
    {
        // Eager load the related models
        $this->products = Product::with(['category', 'visibility', 'status'])->get();

        // Loop through the products and determine their stock levels
        foreach ($this->products as $product) {
            // Determine the stock level for each product based on the 'stocks' field
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }


        // Return the view with the products including their stock level
        return view('livewire.shop.shop-products', [
            'products' => $this->products
        ]);
    }
}
