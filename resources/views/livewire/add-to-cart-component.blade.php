<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class AddToCartComponent extends Component
{
    public $productId;
    public $quantity = 1;

    public function addToCart()
    {
        $product = Product::find($this->productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        // Get the cart from session
        $cart = session()->get('cart', []);

        // Add or update product in the cart
        if (isset($cart[$this->productId])) {
            $cart[$this->productId]['quantity'] += $this->quantity;
        } else {
            $cart[$this->productId] = [
                'name' => $product->name,
                'quantity' => $this->quantity,
                'price' => $product->price,
                'image' => $product->image_url, // Ensure this exists in Product
            ];
        }

        // Store the updated cart
        session()->put('cart', $cart);

        session()->flash('success', 'Product added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.add-to-cart-component');
    }
}

?>