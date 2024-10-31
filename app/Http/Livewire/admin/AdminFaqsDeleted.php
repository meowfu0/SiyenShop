<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Faq;

class AdminFaqsDeleted extends Component
{
    public function render()
    {
        // Fetch deleted FAQs (status_id = 4)
        $faqs = Faq::where('status_id', 4)->get(); 

        return view('livewire.admin.admin-faqs-deleted', [
            'faqs' => $faqs,
        ]);
    }
}
