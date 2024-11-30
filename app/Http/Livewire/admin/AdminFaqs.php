<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Faq;

class AdminFaqs extends Component
{
    public function render()
    {
        $faqs = Faq::all();
        return view('livewire.admin.admin-faqs', compact('faqs'));
    }
}
