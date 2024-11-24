<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\Category;
use App\Models\Product; // Import the Product model

class ShopProducts extends Component
{
    public $products = [];
    public $categories = [];
    public $category;
    public $perPage = 10;
    public $search = '';
    public $productIdToDelete; // Property to hold the ID of the product to delete

    protected $rules = [
        'product_name' => 'required',
        'description' => 'required'
    ];

    public function render()
    {
        // Build the query using the Query Builder
        $query = DB::table('products')
            ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id');

        // Apply search filter if provided
        if ($this->search) {
            $query->where('products.product_name', 'like', '%' . $this->search . '%');
        }

        // Paginate the results
        $this->products = $query->paginate($this->perPage);

        // Fetch unique categories
        $this->categories = DB::table('categories')->select('id', 'category_name')->get();

        // Loop through the products and determine their stock levels
        foreach ($this->products as $product) {
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }

        return view('livewire.shop.shop-products', [
            'products' => $this->products,
            'categories' => $this->categories, // Pass categories to the view
        ]);
    }

    // Method to confirm deletion
    public function confirmDelete($productId)
    {
        $this->productIdToDelete = $productId; // Set the product ID to delete
    }

    // Method to delete the product
    public function deleteProduct()
    {
        Product::find($this->productIdToDelete)->delete(); // Delete the product
        $this->productIdToDelete = null; // Reset the product ID
        $this->emit('productDeleted'); // Emit an event to notify the frontend
    }
}