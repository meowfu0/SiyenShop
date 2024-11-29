<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class FaqController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch FAQs with status_id 1 or any condition you need
        $faqs = Faq::where('status_id', 1)->get();
    
        // Pass $faqs to the view
        return view('customer_support.faqs', compact('faqs'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {

         $validatedData = $request->validate([
             'questions' => 'required|string|max:255',
             'answers' => 'required|string',
         ]);

         $statusId = 1;

         if (!DB::table('statuses')->where('id', $statusId)->exists()) {
             return response()->json(['error' => 'Invalid status ID'], 400);
         }

         $faq = FAQ::create([
             'questions' => $validatedData['questions'],
             'answers' => $validatedData['answers'],
             'status_id' => $statusId,
             'deleted_at' => null,
             'modified_at' => now(),
             'created_at' => now(),
         ]);
     
         return response()->json($faq, 201);
     }
     
     
     
     
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        Log::info("Showing FAQ with ID: $id");
        
        $faq = Faq::find($id);
        
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
        
        // Change the status_id
        $faq->status_id = $faq->status_id == 1 ? 3 : 1;
        $faq->save();
        
        return response()->json(['message' => 'FAQ status changed successfully', 'new_status' => $faq->status_id], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'questions' => 'required|string|max:255',
            'answers' => 'required|string',
        ]);
    
        // Update the FAQ
        $faq->update([
            'questions' => $validatedData['questions'],
            'answers' => $validatedData['answers'],
            'modified_at' => now(),
        ]);
    
        return response()->json($faq, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        Log::info("Updating FAQ status to 4 with ID: $id");
    
        $faq = Faq::find($id);
    
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
    
        // Set the status_id to 4
        $faq->status_id = 4;
        $faq->deleted_at = now();
        $faq->save();
    
        return response()->json([
            'message' => 'FAQ status updated to 4 successfully',
            'new_status' => $faq->status_id,
            'deleted_at'=> now()
        ], 200);
    }
    

    
    
    public function hide(Request $request, $id)
    {
        Log::info("Toggling FAQ status with ID: $id");
    
        $faq = Faq::find($id);
    
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
    
        // Toggle the status_id between 1 and 3
        $faq->status_id = $faq->status_id == 1 ? 3 : 1;
        $faq->save();
    
        return response()->json([
            'message' => 'FAQ status toggled successfully',
            'new_status' => $faq->status_id
        ], 200);
    }

    
}
