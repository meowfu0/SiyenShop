<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentPageController extends Controller
{
    public function index($id)
    {
       

        $ids = base64_decode($id);  // Decode the string
    
        // Convert the comma-separated product IDs into an array
        $productIds = explode(',', $ids);
        return view('user.paymentPage' , compact('productIds'));
    }


   
  
}


