<?php
// app/Http/Livewire/ShopSidenav.php
namespace App\Http\Livewire;

use Livewire\Component;

class ShopSidenav extends Component
{
    public function navigateTo($route)
    {
        return redirect()->route($route);
    }

    public function render()
    {
        return view('livewire.shop-sidenav');
    }
}
