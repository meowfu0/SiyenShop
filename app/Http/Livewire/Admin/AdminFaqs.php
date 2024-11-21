<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Faq;

class AdminFaqs extends Component
{
    public function render()
    {
        $faqs = Faq::whereIn('status_id', [1, 3])->get(); 

        return view('livewire.admin.admin-faqs', ['faqs' => $faqs]);
    }
    
}