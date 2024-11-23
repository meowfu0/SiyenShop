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

    public function retrieve(Request $request)
{
    $faqIds = $request->input('faq_ids'); 
    if (!$faqIds || !is_array($faqIds)) {
        return response()->json(['success' => false, 'error' => 'Invalid data provided'], 400);
    }

    try {
        $defaultStatusId = 1;
        FAQ::whereIn('id', $faqIds)->update(['status_id' => $defaultStatusId]);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}
}

