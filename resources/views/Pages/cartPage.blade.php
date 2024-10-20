@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/cart.js') }}"></script>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-11">
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Cart</h1>
                </div>

                <!------- Shirt Sample ------->                
                <div class="card border border-2 rounded-3 border-gray mb-2 p-2">
                    <div class="card-body p-2 d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-4 d-flex align-items-left form-check">
                                <input type="checkbox" class="form-check-input border border-primary checkboxs" 
                                       onclick="AddCheckedProducts()" id="item1" value="350">
                            </div>    
                            <div class=""> 
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
                            <div class="p-2"><b>Variant/Size</b></div>
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
                            <div class="p-2"><b>Quantity</b></div>
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
                                    <img src="{{ asset('images/trash3.svg') }}" class="mb-1">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--------- Lanyard Sample ------------------->
                <div class="card rounded-3 border border-2 border-gray mb-4 p-2 ">
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
                            <div class="p-2"><b>Variant/Size</b></div>
                            <div class="p-2">
                                <select class="form-select border border-primary size-input"> 
                                    <option selected>None</option>
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
                                    <img src="{{ asset('images/trash3.svg') }}" class="mb-1">
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
                                <h5 class="fs-3 fw-bold mb-0 ms-2 mt-1">Select All (<span id="selectAll-count">2</span>)</h5>
                            </div>
                        </div>
                        <hr>
                        <!-- No. of Items and Total Section -->
                        <div class="d-flex justify-content-between align-items-center px-5">
                            <!-- Item count display -->
                            <div class="col-2 fw-bold">No. of Items: <span id="item-count" class="fw-bold fs-3">0</span> item(s)</div>
                            <!-- Total amount display -->
                            <div>
                                <span class="ms-5 fw-bold fs-4 col-6">TOTAL: ₱ <span id="total-amount" class="fs-4">0</span>.00</span>
                            </div>
                            <!-- Proceed to Checkout button -->
                            <div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalProceed" class="btn btn-primary btn-md p-2 d-flex px-4 gap-2">
                                    Proceed To Checkout
                                    <img src="{{ asset('images/cart3.svg') }}" class="align-items-center">
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
