<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ShopProductsEdit extends Component
{
    public $productId; // Product ID
    public $product_name;
    public $product_decription;
    public $product_image;
    public $category_id;
    public $status_id;
    public $visibility_id;
    public $supplier_price;
    public $retail_price;


    public function mount($productId) // Accept productId as a parameter
    {
        
        $this->productId = $productId; // Set the product ID directly

        // Fetch the product data if productId is set
        if ($this->productId) {
            $product = DB::table('products')->where('id', $this->productId)->first();
            if ($product) {
                $this->product_name = $product->name;
                $this->product_decription = $product->decription;
                // Set other properties as needed
            } else {
                // Handle the case where the product is not found
                session()->flash('error', 'Product not found.');
                return redirect()->route('shop.products'); // Redirect to products index
            }
        }
    }

    public function submit()
    {
        // Validation and saving logic here
        $this->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Save the product logic here
        DB::table('products')->updateOrInsert(
            ['id' => $this->productId],
            [
                'name' => $this->product_name,
                'description' => $this->product_decription,
                // Add other fields as needed
                'updated_at' => now(), // Update timestamp
            ]
        );

        session()->flash('success', 'Product saved successfully.');
    }

    public function render()
    {
        $query = DB::table('products')
        ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
        ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id');
        
        return view('livewire.shop.shop-products-edit'); // No need to pass variables explicitly
    }
}