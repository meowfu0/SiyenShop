<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Shop;
use App\Models\Course;
use App\Models\Order;

class AdminDashboard extends Component
{
    public $userCount;
    public $shopCount;
    public $userCountByCourse = [];
    public $activeUserCount;
    public $topShops = [];
    public $allShops = [];

    public function render()
    {
        $this->userCount = User::count();
        $this->shopCount = Shop::count();
        $this->activeUserCount = User::where('status_id', 1)->count();

        // Get user counts grouped by course name
        $this->userCountByCourse = User::selectRaw('courses.course_name, COUNT(users.id) as count')
            ->join('courses', 'users.course_id', '=', 'courses.id')
            ->groupBy('courses.course_name')
            ->pluck('count', 'courses.course_name')
            ->toArray();

        // Get top shops based on total order amount
        $this->topShops = Shop::join('orders', 'shops.id', '=', 'orders.shop_id')
            ->select('shops.shop_name')
            ->selectRaw('SUM(orders.total_amount) as total_amount')
            ->groupBy('shops.shop_name', 'shops.id')
            ->orderByDesc('total_amount')
            ->limit(5)
            ->get();

        // Get all shops
        $this->allShops = Shop::pluck('shop_name')->toArray();

        return view('livewire.admin.admin-dashboard', [
            'userCount' => $this->userCount,
            'shopCount' => $this->shopCount,
            'userCountByCourse' => $this->userCountByCourse,
            'activeUserCount' => $this->activeUserCount,
            'topShops' => $this->topShops,
            'allShops' => $this->allShops,
        ]);
        
    }
}
