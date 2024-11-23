<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;


class ShopProductsEdit extends Component
{
    use WithFileUploads;

    public $product_id;
    public $product_name;
    public $category_id;
    public $retail_price;
    public $supplier_price;
    public $stocks;
    public $product_image;

    public function mount($id)
    {
        $product = Product::findOrFail($id);

        $this->product_id = $product->id;
        $this->product_name = $product->product_name;
        $this->category_id = $product->category_id;
        $this->retail_price = $product->retail_price;
        $this->supplier_price = $product->supplier_price;
        $this->stocks = $product->stocks;
    }

    public function updateProduct()
    {
        $this->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'retail_price' => 'required|numeric|min:0',
            'supplier_price' => 'required|numeric|min:0',
            'stocks' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::findOrFail($this->product_id);

        // Update image if provided
        if ($this->product_image) {
            // Store the new image
            $imagePath = $this->product_image->store('products', 'public');

            // Delete the old image if exists
            if ($product->product_image) {
                \Storage::delete('public/' . $product->product_image);
            }

            // Update the product with the new image path
            $product->product_image = $imagePath;
        }

        // Update other fields
        $product->update([
            'product_name' => $this->product_name,
            'category_id' => $this->category_id,
            'retail_price' => $this->retail_price,
            'supplier_price' => $this->supplier_price,
            'stocks' => $this->stocks,
        ]);

        session()->flash('message', 'Product updated successfully!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.shop.shop-products-edit', compact('categories'));
    }
}
