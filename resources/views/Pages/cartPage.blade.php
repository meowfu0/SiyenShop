@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cart.js') }}"></script>

    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center h-100"> 
            <div class="col-11">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Cart</h1>
                </div>   

                <!-------shirt Sample ------->                
                <div class="card rounded-3 border-primary mb-2">
                    <div class="card-body p-2 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-4 d-flex align-items-left form-check">
                                <input type="checkbox" class="form-check-input border border-primary checkboxs" 
                                onclick="AddCheckedProducts()" id="item1" value="350">
                            </div>    
                            <div> 
                                <img src="{{ asset('images/sample-shirt.jpg') }}" class="img-fluid rounded-2 img-items">
                            </div>
                        </div>
                        <div class="d-flex align-items-start flex-column">
                            <div class="p-2"><b>Item</b></div>
                            <div class="p-2"><span>CIRCUITS T-Shirt - Black</span></div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Unit Price</b></div>
                            <div class="p-2"><span class="price">₱ 350.00</span></div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Variance/Size</b></div>
                            <div class="p-2">
                                <select class="form-select border border-primary size-input">
                                    <option selected>Large</option>
                                    <option>Medium</option>
                                    <option>Small</option>
                                    <option>X-Large</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Quantity </b></div>
                            <div class="input-group mt-2 border rounded border-primary" style="overflow: hidden; height: 34px;">
                                <button class="btn" type="button" onclick="decrementQuantity('quantity_item1')">-</button>
                                <input id="quantity_item1" min="0" name="quantity" value="1" type="text" readonly
                                       class="form-control text-center outline-primary" style="width: 38px; border: none;">
                                <button class="btn" type="button" onclick="incrementQuantity('quantity_item1')">+</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Total</b></div>
                            <div class="p-2">₱ 350.00</div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-4 d-flex align-items-left">
                                <button type="button" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="CurrentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
 
                <!--------- Lanyard Area Sample ------------------- ---------------------------------------->
                <div class="card rounded-3 border-primary mb-4">
                    <div class="card-body p-2 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-4 d-flex align-items-left form-check">
                            <input type="checkbox" class="form-check-input border border-primary checkboxs" 
                            onclick="AddCheckedProducts()" id="item2" value="250">
                            </div>
                            <div>
                                <img src="{{ asset('images/lanyard-sample.jpg') }}" class="img-fluid rounded-2 img-items">
                            </div>
                        </div> 
                        <div class="d-flex align-items-start flex-column">
                            <div class="p-2"><b>Item</b></div>
                            <div class="p-2"><span>CSC Reversible Lanyard</span></div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Unit Price</b></div>
                            <div class="p-2">₱ 250.00</div> 
                        </div> 
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Variance/Size</b></div>
                            <div class="p-2">
                                <select class="form-select border border-primary size-input"> 
                                    <option selected>none</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Quantity</b></div>
                            <div class="input-group mt-2 border rounded border-primary" style="overflow: hidden; height: 34px;">
                                <button class="btn" type="button" onclick="decrementQuantity('quantity_item2')">-</button>
                                <input id="quantity_item2" min="0" name="quantity" value="1" type="text" readonly
                                       class="form-control text-center outline-primary" style="width: 38px; border: none;">
                                <button class="btn" type="button" onclick="incrementQuantity('quantity_item2')">+</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2"><b>Total</b></div>
                            <div class="p-2">₱ 250.00</div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-4 d-flex align-items-left">
                                <button type="button" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                        <!-- Select All and Checkout Section -->
                        <div class="col-12 fixed-bottom">
                            <div class="container px-5 py-4 bg-white">
                                <div class="col-12 mt-2">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)" class="form-check-input border border-primary checkbox-all">
                                        <h5 class="fs-3 fw-bold mb-0 ms-2 mt-1">Select All (<span id="selectAll">2</span>)</h5>
                                    </div>
                                </div>
                        
                                <hr>
                        
                                <!-- No. of Items and Total Section -->
                                <div class="d-flex justify-content-between align-items-center px-5">
                                    <!-- Item count display -->
                                    <div class="col-2 fw-bold">No. of Items: <span id="item-count" class="fw-bold">0</span> item(s)</div>
                        
                                    <!-- Total amount display -->
                                    <div>
                                        <span class="ms-5 fw-bold fs-4 col-6">TOTAL: ₱ <span id="total-amount">0</span>.00</span>
                                    </div>
                        
                                    <!-- Proceed to Checkout button -->
                                    <div>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalProceed" class="btn btn-primary btn-md">
                                            Proceed To Checkout
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
    <!-- Modal for Proceed to Checkout -->
    @include('Pages.modal.checkoutProceed')

@endsection