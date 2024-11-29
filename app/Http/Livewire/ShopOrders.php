<?php

namespace App\Http\Livewire;

use App\Models\Shop;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Http\Request;

class ShopOrders extends Component
{
    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'shop_id' => 'required|integer',
            'user_id' => 'required|integer',
            'order_status_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'supplier_price_total_amount' => 'required|numeric',
            'total_items' => 'required|integer',
            'order_date' => 'required|date',
            'reference_number' => 'required|string',
            'proof_of_payment' => 'nullable|string'
        ]);
    }

    public function render()
    {

        return view('livewire.shop.shop-orders');
    }
}
?>

