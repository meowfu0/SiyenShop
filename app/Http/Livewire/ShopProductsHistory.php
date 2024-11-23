<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Product;


class ProductHistory extends Component
{
    public function restoreProduct($productId)
    {
        $product = Product::withTrashed()->find($productId);
        if ($product) {
            $product->restore();
            session()->flash('message', 'Product restored successfully!');
        }
    }

    public function render()
    {
        $products = Product::onlyTrashed()->get(); // Fetch deleted products
        return view('livewire.product-history', compact('products'));
    }
}
