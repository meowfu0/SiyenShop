<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ShopDashboard extends Component
{
    public $date; 

    public function getTotals()
    {
        $shopId = 1;

        $query = DB::table('orders')
            ->where('shop_id', $shopId)  
            ->whereYear('order_date', Carbon::now()->year) 
            ->whereMonth('order_date', Carbon::now()->month); 

        // Check if a specific date is provided, and filter by it if so
        if ($this->date) {
            $query->whereDate('order_date', Carbon::parse($this->date));
        }

        // Calculate total amounts
        $totalAmount = $query->sum('total_amount');
        $supplierTotalAmount = $query->sum('supplier_price_total_amount');
        $profit = $totalAmount - $supplierTotalAmount;

        $profitFormatted = number_format($profit,2);
        $totalAmountFormatted = number_format($totalAmount,2);


        return [
            'total_amount' => $totalAmountFormatted,
            'profits' => $profitFormatted ,
        ];
    }

    public function getOrderCount($date) {
        $shopId = 1;
        $query = DB::table('orders')
            ->where('shop_id', $shopId);  
        // If a specific date is provided, filter by it
        if ($date) {
            // If a specific date is provided, count orders for that specific date
            $query->whereDate('order_date', Carbon::parse($date));
        } else {
            // Default to counting orders for the current month
            $query->whereYear('order_date', Carbon::now()->year)
                  ->whereMonth('order_date', Carbon::now()->month);
        }

        // Count the number of orders matching the criteria
        return $query->count();
    } 

    public function getAllOrdersCount()
    {
        $shopId = 1;

        return DB::table('orders')
            ->where('shop_id', $shopId)  
            ->count(); // Count all orders
    }

    public function getLowStockProducts()
    {
        $shopId = 1;
    
        // Fetch products with stock 10 or below for the specified shop_id
        return DB::table('products')
            ->where('shop_id', $shopId)
            ->where('stocks', '<=', 15)
            ->select('product_name', 'stocks')
            ->get();
    }

    public function render()
    {
        $Totals = $this->getTotals();  // totals
        $orderCount = $this->getOrderCount($this->date);
        $allOrdersCount = $this->getAllOrdersCount();
        $lowStockProducts = $this->getLowStockProducts();  // Fetch low stock products
        return view('livewire.shop.shop-dashboard', ['Totals' => $Totals , 'orderCount' => $orderCount, 'allOrdersCount' => $allOrdersCount, 'lowStockProducts' => $lowStockProducts]);
    }
}
