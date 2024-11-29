<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminChat extends Component
{
    public $contacts = [];
    public $recipientId;
    public $messages = [];
    public $message;

    public function mount($recipientId)
    {
        $this->recipientId = $recipientId;
        $this->fetchContacts();
        $this->fetchMessages();
    }

    public function fetchContacts()
    {
        $userId = Auth::id();
        $this->contacts = User::where('id', '!=', $userId)->get(); // Example query
    }

    public function render()
    {
        return view('livewire.admin.admin-chat');
    }
    
}
