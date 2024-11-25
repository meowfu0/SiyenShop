<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Dashboard extends Component
{
    public $startDate;
    public $endDate;
    public $shopId;


    // Define listeners
    protected $listeners = ['dateRangeUpdated'];


    public function dateRangeUpdated($startDate, $endDate)
    {
   
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->getShopId();
        Log::info('Date Range Updated:', ['startDate' => $this->startDate, 'endDate' => $this->endDate]);

    }

    public function getShopId() {
        $user_id = Auth::user()->id; 
    
        // Fetch the shop_id from the database
        $result = DB::table('g_cash_infos')
            ->where('user_id', $user_id)
            ->value('shop_id'); // Directly get the `shop_id` column value
    
        // Set the shopId 
        $this->shopId = $result;
    
        return $this->shopId;
    }

    public function getShopInfo()
{
    // Ensure `shopId` is set
    if (!$this->shopId) {
        $this->getShopId(); 
    }

    // Fetch shop_name and shop_logo
    $shopInfo = DB::table('shops')
        ->where('id', $this->shopId)
        ->select('shop_name', 'shop_logo')
        ->first();

    return $shopInfo;
}
    

    public function getTotalsProperty()
    {
    
        $query = DB::table('orders')
        ->where('shop_id', $this->shopId);
        if ($this->startDate === $this->endDate) {
            // Apply a single date filter
            $query->whereDate('order_date', $this->startDate);
        } else {
            // Apply a range filter
            $query->whereBetween('order_date', [$this->startDate, $this->endDate]);
        }

        $totalAmount = $query->sum('total_amount');
        $supplierTotalAmount = $query->sum('supplier_price_total_amount');
        $profit = $totalAmount - $supplierTotalAmount;

        return [
            'total_amount' => number_format($totalAmount, 2),
            'profits' => number_format($profit, 2),
        ];
    }

    public function getOrderCountProperty()
    {
        $query = DB::table('orders')
            ->where('shop_id', $this->shopId);
        if ($this->startDate === $this->endDate) {
            // Apply a single date filter
            $query->whereDate('order_date', $this->startDate);
        } else {
            // Apply a range filter
            $query->whereBetween('order_date', [$this->startDate, $this->endDate]);
        }
    
        // Return the count of records
        return $query->count();
    }
    

    public function getAllOrdersCountProperty()
    {
        return DB::table('orders')
            ->where('shop_id', $this->shopId)
            ->count();
    }

    public function getRecentOrders($limit = 12)
    {
        $query = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('courses', 'users.course_id', '=', 'courses.id')
            ->select(
                'orders.*',
                'users.first_name as user_fname',
                'users.last_name as user_lname',
                'courses.course_name as course'
            )
            ->where('orders.shop_id', $this->shopId);
    
        // Apply date logic
        if ($this->startDate === $this->endDate) {
            // Apply a single date filter
            $query->whereDate('orders.order_date', $this->startDate);
        } else {
            // Apply a range filter
            $query->whereBetween('orders.order_date', [$this->startDate, $this->endDate]);
        }
    
        // Add sorting, limit, and get the results
        return $query
            ->orderBy('orders.order_date', 'desc')
            ->limit($limit)
            ->get();
    }
    

    public function getUnverifiedOrders($limit = 5)
    {
        $orderStatusId = DB::table('statuses')
        ->where('status_name', 'pending')
        ->pluck('id');

        return DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.id', 
                'orders.reference_number',
                'users.first_name as user_fname', 
                'users.last_name as user_lname',
            )
            ->where('orders.shop_id', $this->shopId)
            ->whereIn('orders.order_status_id', $orderStatusId)
            ->whereBetween('orders.order_date', [$this->startDate, $this->endDate])
            ->orderBy('orders.order_date', 'asc')
            ->limit($limit)
            ->get();
    }

    public function getLowStockProducts($limit = 5)
    {
    
        // Fetch products with stock 10 or below for the specified shop_id
        return DB::table('products')
            ->where('shop_id', $this->shopId)
            ->where('stocks', '<=', 15)
            ->select('product_name', 'stocks')
            ->limit($limit)
            ->get();
    }

    public function render()
    {
        $formattedStartDate = Carbon::parse($this->startDate)->format('F j, Y');
        $formattedEndDate = Carbon::parse($this->endDate)->format('F j, Y');

        return view('livewire.seller.dashboard', [
            'Totals' => $this->totals,
            'orderCount' => $this->orderCount,
            'allOrdersCount' => $this->allOrdersCount,
            'recentOrders' => $this->getRecentOrders(),
            'lowStockProducts' => $this-> getLowStockProducts(),
            'unverifiedOrders' => $this->getUnverifiedOrders(),
            'startDate' => $formattedStartDate,
            'endDate' => $formattedEndDate,
            'shopInfo' => $this->getShopInfo()
        ]);
        
    }

}
