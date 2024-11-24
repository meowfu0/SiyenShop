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
    public $perPage = 10;
    public $search = '';

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
}