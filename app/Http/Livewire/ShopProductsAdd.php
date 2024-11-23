<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ShopProductsAdd extends Component
{
    public $name, $price, $stocks, $category_id, $status;

    // Method to save the product data
    public function saveProduct()
    {
        // Validate form fields
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stocks' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string',
        ]);

        // Save the new product to the database
        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stocks' => $this->stocks,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ]);

        // Reset form fields after saving
        $this->reset();

        // Provide success message after saving
        session()->flash('message', 'Product added successfully!');

        // Redirect to the products page
        return redirect()->route('shop.products');
    }

    // Render the component view
    public function render()
    {
        // Retrieve categories for dropdown
        $categories = Category::all();
        return view('livewire.shop.shop-products-add', compact('categories'));
    }
}
