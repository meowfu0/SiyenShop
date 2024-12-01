<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class ShopProductsAdd extends Component
{
    use WithFileUploads;

    public $product_name;
    public $product_description;
    public $product_image;
    public $category_id;
    public $status_id;
    public $visibility_id;
    public $supplier_price;
    public $retail_price;
    public $stocks;

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string',
        'product_image' => 'nullable|image|max:2048',
        'category_id' => 'required|integer',
        'status_id' => 'required|integer',
        'visibility_id' => 'required|integer',
        'supplier_price' => 'required|numeric',
        'retail_price' => 'required|numeric',
        'stocks' => 'integer',
        'variantStocks' => 'integer',
        'size' => 'string|max:20',
    ];

    public function create()
    {
        // Validate the input with explicit rules
        $validatedData = $this->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:1000',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'visibility_id' => 'required|exists:visibility,id',
            'supplier_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'stocks' => 'nullable|integer|min:0', // stocks should be nullable
            'size' => 'required|string|max:50', // Assuming size is required
        ]);

        // Check if variants are available, in which case we skip 'stocks' in the product table
        $stocks = $this->stocks ?? 0;  // Default to 0 if not set
        $includeStocksInProduct = !$this->hasVariants();  // Determine if we should include stocks in the product table

        // Store the product in the database
        $productData = [
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_image' => $this->product_image->store('products', 'public'),
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'visibility_id' => $this->visibility_id,
            'supplier_price' => $this->supplier_price,
            'retail_price' => $this->retail_price,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Conditionally add stocks only if no variants exist
        if ($includeStocksInProduct) {
            $productData['stocks'] = $stocks;
        }

        $productId = DB::table('products')->insertGetId($productData);

        // Store the product variants in the database if variants are available
        if ($this->hasVariants()) {
            DB::table('product_variants')->insert([
                'product_id' => $productId,  // Use the ID of the recently inserted product
                'stocks' => $stocks,  // You can adjust how you handle stocks in variants
                'size' => $this->size,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Flash success message and redirect to the products page
        session()->flash('message', 'Product added successfully.');
        return redirect()->route('shop.products'); // Redirect to the products page
    }

    // Helper method to check if variants are available
    public function hasVariants()
    {
        // You can modify this condition based on your logic to detect if variants exist
        return isset($this->size) && !empty($this->size);
    }



    public function render()
    {
        // Fetch categories to pass to the view
        $categories = DB::table('categories')->get();

        return view('livewire.shop.shop-products-add', [
            'categories' => $categories,
        ]);
    }
}