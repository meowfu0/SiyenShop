<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShopProductsHistory extends Component
{
    public $products = [];
    public $perPage = 10;
    public $search = '';

    public function mount()
    {
        // Load historical products or any relevant data
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Fetch products with their historical data
        // You can modify this query to fit your historical data logic
        $this->products = Product::with(['category', 'visibility', 'status'])
            ->where('updated_at', '<', now()->subMonths(1)) // Example: products updated more than a month ago
            ->get();

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
    }

    public function render()
    {
        return view('livewire.shop.shop-products-history', [
            'products' => $this->products,
        ]);
    }
}
