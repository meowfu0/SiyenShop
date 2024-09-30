<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShopSidenav extends Component
{
    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = request()->route()->getName();
    }
    public function render()
    {
        return view('livewire.shop-sidenav');
    }
}
