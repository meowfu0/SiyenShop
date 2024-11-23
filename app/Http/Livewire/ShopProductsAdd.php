<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Livewire\WithFileUploads;

class ShopProductsAdd extends Component
{
    use WithFileUploads;

    public $category_id;
    public $shop_id;
    public $status_id;
    public $visibility_id;
    public $product_name;
    public $product_description;
    public $product_image;
    public $supplier_price;
    public $retail_price;
    public $sales_count = 0; // Default to 0
    public $stocks;

    protected $rules = [
        'category_id' => 'required|integer',
        'shop_id' => 'required|integer',
        'status_id' => 'required|integer',
        'visibility_id' => 'required|integer',
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string',
        'product_image' => 'required|image|max:2048', // Image is required
        'supplier_price' => 'required|numeric',
        'retail_price' => 'required|numeric',
        'sales_count' => 'nullable|integer',
        'stocks' => 'required|integer',
    ];

    public function submit()
    {
        $this->validate();

        // Handle image upload
        $imagePath = $this->product_image->store('images/products', 'public');

        // Insert the new product into the database
        DB::table('products')->insert([
            'category_id' => $this->category_id,
            'shop_id' => $this->shop_id,
            'status_id' => $this->status_id,
            'visibility_id' => $this->visibility_id,
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_image' => $imagePath,
            'supplier_price' => $this->supplier_price,
            'retail_price' => $this->retail_price,
            'sales_count' => $this->sales_count,
            'stocks' => $this->stocks,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Product added successfully.');

        // Reset the form fields
        $this->reset();
    }

    public function render()
    {
        // Fetch categories to pass to the view
        $categories = DB::table('categories')->get();

        return view('livewire.shop.shop-products-add', [
            'categories' => $categories, // Pass categories to the view
        ]);
    }
}