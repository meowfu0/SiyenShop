@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cart.js') }}"></script>

    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center h-100"> 
            <div class="col-11">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Checkout</h1> 
                </div>   
                <h3 class="mt-2 mb-3 fw-bold  fs-5 text-primary">Order Summary</h3>
                <!------- Sample data ------->                
                <div class="border rounded-3 border-primary table-responsive">
                              <table class="table border-primary mt-2 p-2">
                                        <thead class="table-head">
                                            <tr class="fw-bold fs-4">
                                            <th>Item</th>
                                            <th>Unit Price</th>
                                            <th>Variant/Size</th>
                                            <th>Quantity</th>
                                            <th>Item Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="noBorder">
                                        
                                            <td>CIRCUITS T-Shirt - Black</td>
                                            <td>₱350.00</td>
                                            <td>Large</td>
                                            <td>1</td>
                                            <td>₱250.00</td>
                                        </tr>
                                                 <tr>
                                                    <td>CSC Reversible Lanyard</td>
                                                    <td>₱150.00</td>
                                                    <td class="fst-italic">None</td>
                                                    <td>1</td>
                                                    <td>₱150.00</td>
                                                </tr>
                                                <tr>
                                                    <td>CSC Reversible Lanyard</td>    
                                                    <td>₱150.00</td>
                                                    <td class="fst-italic">None</td>
                                                    <td>1</td>
                                                    <td>₱150.00</td>
                                                </tr>
                                                <tr>
                                            <td>CIRCUITS T-Shirt - Black</td>
                                            <td>₱350.00</td>
                                            <td>Large</td> 
                                            <td>1</td>
                                            <td>₱250.00</td>
                                        </tr>   
                                     
                                               
                                        </tbody>
                                    </table>
                         </div>
                            
                        
                            <div class="col-12 fixed-bottom">
                            <div class="container px-5 pt-2 pb-4 bg-white">
                                <div class="col-12 mt-2">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-2 fst-italic fw-light mb-0 ms-2 mt-1">*Ensure you have carefully read and agreed to the terms and conditions before finalizing your order.</h5>
                                    </div>
                                </div>
                        
                                <hr>
                        
                                <!-- No. of Items and Total Section -->
                                <div class="d-flex justify-content-between align-items-center px-5">
                                    <!-- Item count display -->
                                    <div class="col-2 mt-2"><p class="fw-bold">No. of Items:  <span class="fw-normal">4 item(s)</span></p></div>
                        
                                    <!-- Total amount display -->
                                    <div class="mt-2">
                                       <p class=" fs-4"><span class="ms-5 fw-bold col-6">Total Payment: </span><span>₱ 1,000.00</span></p>  
                                    </div>
                        
                                    <!-- Proceed to Checkout button -->
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('cartPage') }}" class="btn btn-outline-primary btn-md me-1">Cancel</a>
                                        
                                        <a href="{{ route('paymentPage') }}" class="btn btn-primary btn-md">
                                            Place Order
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                            </svg>
                                        </a>
                                        </div>
                                 </div>
                            </div>
                        </div>
                            </div>
                        </div>
               
            </div> 
        </div> 
    </div>
    <!-- Modal for Proceed to Checkout -->
    

@endsection