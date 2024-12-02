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
        'stocks' => 'required|integer',
    ];
    
    public function create()
    {
        // Get the data from the request
        $data = request()->all();

        // Check if variation toggle is checked and adjust stocks accordingly
        if (isset($data['variationToggle']) && $data['variationToggle'] == 'on') {
            $stocks = 0;  // Set stocks to 0 when variation is checked
        } else {
            $stocks = $data['stocks'];  // Use the value of stocks from the form
        }

        // Validate the data with the adjusted stocks value
        $this->validate($data, $this->rules);

        // Store the product in the database
        DB::table('products')->insert([
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_image' => $this->product_image->store('products', 'public'),
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'visibility_id' => $this->visibility_id,
            'supplier_price' => $this->supplier_price,
            'retail_price' => $this->retail_price,
            'stocks' => $stocks,  // Ensure the correct stocks value is passed here
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        session()->flash('message', 'Product added successfully.');
        return redirect()->route('shop.products'); // Redirect to the products page
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