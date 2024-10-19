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
                <h3 class="mt-2 mb-3 fw-bold fs-5 text-primary">Order Summary</h3>

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
                            <tr>
                                <td>CIRCUITS T-Shirt - Black</td>
                                <td>₱350.00</td>
                                <td>Large</td>
                                <td>1</td>
                                <td>₱350.00</td> <!-- Correct subtotal -->
                            </tr>
                            <tr>
                                <td>CSC Reversible Lanyard</td>
                                <td>₱250.00</td>
                                <td class="fst-italic">None</td>
                                <td>1</td>
                                <td>₱250.00</td> <!-- Correct subtotal -->
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
                            <div class="col-2 mt-2">
                                <p class="fw-bold">No. of Items: <span class="fw-normal">2 item(s)</span></p>
                            </div>
                            
                            <!-- Total amount display -->
                            <div class="mt-2">
                                <p class="fs-4"><span class="ms-5 fw-bold col-6">Total Payment:</span> <span>₱ 600.00</span></p>  
                            </div>

                            <!-- Proceed to Checkout button -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('cartPage') }}" class="btn btn-outline-primary btn-md me-1">Cancel</a>
                                <a href="{{ route('paymentPage') }}" class="btn btn-primary btn-md" style="width: 150px;">
                                    Place Order
                                    <img src="{{ asset('images/cart3.svg') }}" class="mb-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
