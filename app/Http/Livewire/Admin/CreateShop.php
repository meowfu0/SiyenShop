<?php

class CreateShop extends Component
{
    public $managers;

    public function mount()
    {
        $users = User::where('role_id', 'manager')->get();

    }

    public function render()
    {
        return view('livewire.admin.create-shop', [
            'managers' => $this->managers,
        ]);
    }
}

