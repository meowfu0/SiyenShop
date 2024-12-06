<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopProductsHistory extends Component
{
    public $products = [];
    public $perPage = 10;
    public $search = '';

    public function mount()
    {
        // Load historical products or any relevant data
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Fetch products with their historical data
        // You can modify this query to fit your historical data logic
        $this->products = Product::with(['category', 'visibility', 'status'])
        ->where('modified_at', '<', now()->subMonths(1)) // Corrected to use `modified_at`
        ->get();


        // Loop through the products and determine their stock levels
        foreach ($this->products as $product) {
            // Determine the stock level for each product based on the 'stocks' field
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }
    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $shopId = $this->getShopId(); // Call the newly defined method

        // Fetch the shop based on the shopId
        $shop = DB::table('shops')->where('id', $shopId)->first();

        if (!$shop) {
            session()->flash('error', 'No shop found for this user.');
            return view('livewire.shop.shop-products', [
                'products' => [],
                'categories' => [],
                'shop' => null,
            ]);
        }

        $deletedProducts = Product::with(['category', 'shop', 'status', 'visibility'])
            ->whereNotNull('deleted_at')
            ->get();

        return view('livewire.shop.shop-products-history', [
            'products' => $deletedProducts,
            'shop' => $shop,
        ]);
    }

    // Define the getShopId method
    public function getShopId()
    {
        $user_id = Auth::user()->id;

        // Fetch the shop_id associated with the user
        $shop_id = DB::table('g_cash_infos')
            ->where('user_id', $user_id)
            ->value('shop_id'); // Directly get the shop_id

        return $shop_id;
    }
}
