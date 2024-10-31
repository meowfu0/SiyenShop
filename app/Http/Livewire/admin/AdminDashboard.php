<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Shop; 

class AdminDashboard extends Component
{
    public $userCount;
    public $shopCount;

    public function render()
    {
        $this->userCount = User::count();
        $this->shopCount = Shop::count(); 
        return view('livewire.admin.admin-dashboard', [
            'userCount' => $this->userCount,
            'shopCount' => $this->shopCount,
        ]);
    }
}

