@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cart.js') }}"></script>

    <div class="container pt-5">
        <div class="row d-flex justify-content-center align-items-center h-100"> 
            <div class="col-11">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Checkout</h1> 
                </div>   
                <h3 class="mt-2 mb-3 fw-bold fs-5 text-primary">Order Summary</h3>

                <!------- Sample data ------->                
                <div class="border rounded-3 border-primary border-1 table-responsive">
                    <table class="table border-primary mt-2 p-2">
                        <thead class="table-head">
                            <tr class="fw-bold fs-4">
                                <th class="text-primary">Item</th>
                                <th class="text-primary remove">Unit Price</th>
                                <th class="text-primary">Variant/Size</th>
                                <th class="text-primary">Quantity</th>
                                <th class="text-primary">Item Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="noBorder">
                            <tr>
                                <td>CIRCUITS T-Shirt - Black</td>
                                <td class="remove">₱350.00</td>
                                <td>Large</td>
                                <td>x1</td>
                                <td>₱350.00</td>
                            </tr>
                            <tr>
                                <td>CSC Reversible Lanyard</td>
                                <td class="remove">₱250.00</td>
                                <td class="fst-italic">None</td>
                                <td>x1</td>
                                <td>₱250.00</td>
                            </tr>  
                        </tbody>
                    </table>
                </div>

                <div class="col-12 fixed-bottom">
                    <div class="container px-5 pt-2 pb-4 bg-white">
                        <div class="col-12 mt-2">
                            <div class="d-flex align-items-center">
                                <h5 class="fs-3 fst-italic fw-light mb-0 ms-2 mt-1 checkout-sizes">
                                    *Ensure you have carefully read and agreed to the terms and conditions before finalizing your order.
                                </h5>
                            </div>
                        </div>

                        <hr class="hr-fixed">

                        <!-- No. of Items and Total Section -->
                        <div class="d-flex justify-content-evenly align-items-center">
                            <!-- Item count display -->
                            <div class="d-flex justify-content-between col-7 items-payment"> 
                                <div class="col-6 mt-2 d-flex items-check">
                                    <p class="fw-bold my-2 fs-4 text-primary checkout-sizes">
                                        No. of Items: <span class="fw-normal fs-4 checkout-sizes">2 <span class="fw-normal fs-4 checkout-sizes">item(s)</span></span>
                                    </p>
                                </div>

                                <!-- Total amount display -->
                                <div class="col-6 mt-2 d-flex justify-content-center items-pay">
                                    <p class="fw-bold my-2 fs-4 text-primary checkout-sizes">
                                        Total Payment: <span class="fw-normal fs-4 checkout-sizes">₱ <span class="fw-normal fs-4 checkout-sizes">600.00</span></span>
                                    </p>
                                </div>
                            </div>

                            <!-- Proceed to Checkout button -->
                            <div class="d-flex justify-content-end flex-row mt-1 items-btn">
                                <a href="{{ route('cartPage') }}" class="btn btn-outline-primary btn-md me-1 checkout-sizes">Cancel</a>
                                <a href="{{ route('paymentPage') }}" class="btn btn-primary btn-md checkout-sizes" style="width: 150px;">
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
