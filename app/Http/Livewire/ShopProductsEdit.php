<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShopProductsEdit extends Component
{
    public $productId;
    public $product_name;
    public $product_description;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadProduct();
    }

    public function loadProduct()
    {
        $product = Product::find($this->productId);
        if ($product) {
            $this->product_name = $product->name;
            $this->product_description = $product->description;
        } else {
            session()->flash('message', 'Product not found.');
        }
    }

    public function update()
    {
        $this->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
        ]);

        $product = Product::find($this->productId);
        if ($product) {
            $product->name = $this->product_name;
            $product->description = $this->product_description;
            $product->save();

            session()->flash('message', 'Product updated successfully.');
        } else {
            session()->flash('message', 'Product not found.');
        }
    }

    public function render()
    {
        return view('livewire.shop.shop-products-edit');
    }
}