<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShopDashboard extends Component
{
    public function render()
    {
        return view('livewire.shop.shop-dashboard');
    }
}