<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShopDashboard extends Component
{
    public $startDate;
    public $endDate;

    // Define listeners
    protected $listeners = ['dateRangeUpdated'];


    public function dateRangeUpdated($startDate, $endDate)
    {
        Log::info('dateRangeUpdated called', [
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getTotalsProperty()
    {
        $shopId = 1;

        $query = DB::table('orders')
            ->where('shop_id', $shopId)
            ->whereBetween('order_date', [$this->startDate, $this->endDate]);

        $totalAmount = $query->sum('total_amount');
        $supplierTotalAmount = $query->sum('supplier_price_total_amount');
        $profit = $totalAmount - $supplierTotalAmount;

        Log::info('Calculating totals for date range', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalAmount' => $totalAmount,
            'profit' => $profit
        ]);

        return [
            'total_amount' => number_format($totalAmount, 2),
            'profits' => number_format($profit, 2),
        ];
    }

    public function getOrderCountProperty()
    {
        $shopId = 1;

        return DB::table('orders')
            ->where('shop_id', $shopId)
            ->whereBetween('order_date', [$this->startDate, $this->endDate])
            ->count();
    }

    public function getAllOrdersCountProperty()
    {
        $shopId = 1;

        return DB::table('orders')
            ->where('shop_id', $shopId)
            ->count();
    }

    public function getRecentOrders($limit = 10)
    {
        $shopId = 1;

        return DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('courses', 'users.course_id', '=', 'courses.id')
            ->select('orders.*', 'users.first_name as user_fname', 'users.last_name as user_lname', 'courses.course_name as course')
            ->where('orders.shop_id', $shopId)
            ->whereBetween('orders.order_date', [$this->startDate, $this->endDate])
            ->orderBy('orders.order_date', 'desc')
            ->limit($limit)
            ->get();
    }

    public function render()
    {
        return view('livewire.shop.shop-dashboard', [
            'Totals' => $this->totals,
            'orderCount' => $this->orderCount,
            'allOrdersCount' => $this->allOrdersCount,
            'recentOrders' => $this->getRecentOrders()
        ]);
    }
}