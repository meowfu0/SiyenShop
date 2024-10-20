@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cart.js') }}"></script>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100"> 
            <div class="col-11">
                <!-- Order Review Header -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fs-6 fw-bold">Order Review</h1> 
                </div>   
                

                <!-- Order Review Table -->
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
                                <td>₱350.00</td>
                            </tr>
                            <tr>
                                <td>CSC Reversible Lanyard</td>
                                <td>₱150.00</td>
                                <td class="fst-italic">None</td>
                                <td>1</td>
                                <td>₱150.00</td>
                            </tr>       
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-start align-items-center mb-2 mt-4">
                    <img src="{{ asset('images/credit-card.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fs-6 fw-bold">Transactions</h1> 
                </div>   

             
                <div class="container mt-3 rounded-3">
                    <div class="transactions-container row border border-primary rounded-3"> 
                        <div class="col-md-6 p-4 border-left">
                            <h4 class="ms-5 fw-bold text-primary fs-5">GCash Receiver</h4>
                            <ul class="list-unstyled mt-4 ms-5">
                                <li><strong class="text-primary">Mode of Payment:</strong> <span class="ps-5">GCash</span></li>
                                <li><strong class="text-primary">Org GCash No#:</strong> <span class="ps-5 ms-2">0912345678</span></li>
                            </ul>
                        </div>
                        <div class="col-md-6 p-3">
                            <h4 class="ms-5 fw-bold text-primary mt-1 fs-5">GCash Sender</h4>
                            <ul class="list-unstyled mt-3 ms-5">
                                <li><strong class="text-primary">Shop Name:</strong> <span class="ps-5 ms-5"> CirCuits</span></li>
                                <li><strong class="text-primary">No.of Items:</strong> <span class="ps-5 ms-5"> 2</span> item(s)</li>
                                <li>
                                    <strong>Proof of Payment:</strong>
                                    <span class="ps-5 ms-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewProof">Proof of Payment Image</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Checkout Section -->
                <div class="col-12 fixed-bottom">
                    <div class="container px-5 pt-2 pb-3 bg-white">
                    <div class="col-12 mt-2">
                                 
                                 <hr>
   
                        <div class="d-flex justify-content-between align-items-center px-5">
                            <div class="col-2 m-0 p-0">
                                <p class="fw-bolder text-primary mb-0">Shop Name: <span class="fw-normal fs-3">CirCuits</span></p>
                                <p class="fw-bolder text-primary mb-0">No. of Items: <span class="fw-normal fs-3">2 item(s)</span></p>
                            </div>

                            <div class="mt-2">
                                <p class="fs-4">
                                    <span class="ms-1 fw-bolder col-6 fs-4">Total Payment:</span>
                                    <span class="fs-4">₱ 600.00</span>
                                </p>  
                            </div>

                            <!-- Proceed to Checkout button -->
                            <div class="d-flex justify-content-end">  
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalConfirmed" class="btn btn-primary btn-md" style="width: 200px;">
                                    Check Out
                                    <img src="{{ asset('images/cart3.svg') }}" class="mb-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
    @include('Pages.modal.proofOfPayment')
    @include('Pages.modal.checkoutConfirmation')
@endsection
