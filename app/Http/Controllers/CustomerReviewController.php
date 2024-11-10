<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class CustomerReviewController extends Controller  
{  
    public function index(Request $request)  
    {  
        // Retrieve product_id from the request query parameters 
        $product_id = $request->input('product_id'); 
        

        // Retrieve all reviews for the specified product ID  
        $reviews = Review::where('product_id', $product_id)
                         ->with('user') 
                         ->get();  

        // Calculate the average rating for the product 
        $averageRating = $reviews->avg('ratings');  
        $roundedAverageRating = number_format($averageRating, 1);

        // Pass the reviews and rounded rating to the view 
        return view('user.customerReview', compact('reviews', 'roundedAverageRating', 'averageRating')); 
    }  
}
