<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopProducts extends Component
{
    public $products = [];
    public $categories = [];
    public $category;
    public $search = '';

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

        // Build the query for products
        $query = DB::table('products')
            ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id')
            ->whereNull('products.deleted_at')
            ->where('products.shop_id', $shopId);

        if ($this->search) {
            $query->where('products.product_name', 'like', '%' . $this->search . '%');
        }

        $this->products = $query->get();
        $this->categories = DB::table('categories')->select('id', 'category_name')->get();

        foreach ($this->products as $product) {
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } elseif (is_null($product->stocks)) {
                $product->stocks_level = '';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }

        return view('livewire.shop.shop-products', [
            'products' => $this->products,
            'categories' => $this->categories,
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
