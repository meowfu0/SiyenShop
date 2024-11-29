<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\Category;

class ShopProducts extends Component
{
    public $products = [];
    public $categories = [];
    public $category;
    public $search = '';

    public function render()
    {
        // Build the query using the Query Builder
        $query = DB::table('products')
            ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id')
            // Only select products where deleted_at is null (not deleted)
            ->whereNull('products.deleted_at');

        // Apply search filter if provided
        if ($this->search) {
            $query->where('products.product_name', 'like', '%' . $this->search . '%');
        }

        // Fetch all products without pagination
        $this->products = $query->get();

        // Fetch unique categories
        $this->categories = DB::table('categories')->select('id', 'category_name')->get();

        // Loop through the products and determine their stock levels
        foreach ($this->products as $product) {
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } elseif (is_null($product->stocks)) { // Check if stocks is null
                $product->stocks_level = '';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }

        return view('livewire.shop.shop-products', [
            'products' => $this->products,
            'categories' => $this->categories, // Pass categories to the view
        ]);
    }
}
