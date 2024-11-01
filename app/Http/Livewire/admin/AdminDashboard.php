<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Shop;
use App\Models\Course;

class AdminDashboard extends Component
{
    public $userCount;
    public $shopCount;
    public $userCountByCourse = [];

    public function render()
    {
        $this->userCount = User::count();
        $this->shopCount = Shop::count();

        // Get user counts grouped by course name
        $this->userCountByCourse = User::selectRaw('courses.course_name, COUNT(users.id) as count')
            ->join('courses', 'users.course_id', '=', 'courses.id')
            ->groupBy('courses.course_name')
            ->pluck('count', 'courses.course_name')
            ->toArray();

        return view('livewire.admin.admin-dashboard', [
            'userCount' => $this->userCount,
            'shopCount' => $this->shopCount,
            'userCountByCourse' => $this->userCountByCourse,
        ]);
    }
}
