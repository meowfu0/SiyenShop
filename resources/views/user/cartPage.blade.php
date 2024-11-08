@extends('layouts.app')

@section('content')
    
    <script src="{{ asset('js/cart.js') }}"></script>
    

    <div class="container pt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12  col-md-12 col-lg-12  col-xl-12">

                <div class="d-flex justify-content-start align-items-center mb-2">  
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Cart</h1>
                </div>

                <!------- Shirt Sample ------->                
           
                    <div class="card-body  d-flex justify-content-between border border-2 rounded-3 border-grey p-2 mb-2"id="main-card" >
                        <div class="d-flex flex-row align-items-center" >
                            <div class="p-4 d-flex align-items-left" id="form-check">
                                <input type="checkbox" class="form-check-input border border-primary checkboxs" 
                                       onclick="AddCheckedProducts()" id="item1" value="350">
                            </div>    
                            <div> 
                                <img src="{{ asset('images/sample-shirt.jpg') }}" class="img-fluid rounded-2 img-items">
                            </div>
                        </div>

          <div class="d-flex align-items-start flex-row justify-content-between gap-5" id="ProductName">
                        <div class="d-flex align-items-start flex-column">
                            <div class="p-2 text-primary" id="remove"><b>Item</b></div>
                            <div class="p-2 fixed-width" id="prod-name"><p class="mt-2" id="name">CIRCUITS T-Shirt - Black</p></div>
                        </div>

         <div class="d-flex align-items-start flex-row gap-5" id="Price-Variant" > 
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2  text-primary" id="remove" ><b>Unit Price</b></div>
                            <div class="p-2" id="amount"><p class="price mt-2" >₱ 350.00</p></div>
                        </div>
                         
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2  text-primary" id="remove"><b>Variant/Size</b></div>
                            <div class="p-2  text-primary">
                                <select class="form-select border border-primary size-input">
                                    <option selected>Large</option>
                                    <option>Medium</option>
                                    <option>Small</option>
                                    <option>X-Large</option>
                                </select>
                            </div>
                        </div>
                    </div>
                 </div>
                        <div class="d-flex align-items-center flex-column"id="input-quantity">
                            <div class="p-2  text-primary" id="remove"><b>Quantity</b></div>
                            <div class="input-group mt-2 border rounded border-primary" id="Quantity-input" style="overflow: hidden; height: 34px;">
                                <button class="btn no-hover" id="buttons" type="button" onclick="decrementQuantity('quantity_item1')">-</button>
                                <input id="quantity_item1" min="0" name="quantity" value="1" type="text" readonly
                                       class="form-control text-center outline-primary" style="width: 38px; border: none;">
                                <button class="btn no-hover" id="buttons" type="button" onclick="incrementQuantity('quantity_item1')">+</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column" id="remove">
                            <div class="p-2  text-primary"id="remove"><b>Total</b></div>
                            <div class="p-2"><p class="mt-1">₱ 250.00 </p></div> 
                        </div>
                        <div class="d-flex flex-row align-items-center" id="trashbin">
                            <div class="p-4 d-flex align-items-left" id="trashbin">
                                <button type="button" class="btn" id="trashbin-main">
                                    <img src="{{ asset('images/trash3.svg') }}" class="mt-1">
                                </button>
                            </div>
                        </div>
                    </div>

                                    <!------- Lanyard Sample ------->                
           
                    <div class="card-body  d-flex justify-content-between border border-2 rounded-3 border-grey p-2 mb-2"id="main-card" >
                        <div class="d-flex flex-row align-items-center" >
                            <div class="p-4 d-flex align-items-left" id="form-check">
                                <input type="checkbox" class="form-check-input border border-primary checkboxs" 
                                       onclick="AddCheckedProducts()" id="item2" value="250">
                            </div>    
                            <div> 
                            <img src="{{ asset('images/lanyard-sample.jpg') }}" class="img-fluid rounded-2 img-items"></div>
                        </div>

          <div class="d-flex align-items-start flex-row justify-content-between gap-5" id="ProductName">
                        <div class="d-flex align-items-start flex-column">
                            <div class="p-2  text-primary" id="remove"><b>Item</b></div>
                            <div class="p-2  fixed-width" id="prod-name"><p class="mt-2" id="name">CSC Reversible Lanyard
                            </p></div>
                        </div>

         <div class="d-flex align-items-start flex-row gap-5" id="Price-Variant" > 
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2  text-primary" id="remove" ><b>Unit Price</b></div>
                            <div class="p-2" id="amount"><p class="price mt-2" >₱ 250.00</p></div>
                        </div>
                         
                        <div class="d-flex align-items-center flex-column">
                            <div class="p-2  text-primary" id="remove"><b>Variant/Size</b></div>
                            <div class="p-2">
                                <select class="form-select border border-primary size-input">
                                    <option selected>none</option>
                                </select>
                            </div>
                        </div>
                    </div>
                 </div>
                        <div class="d-flex align-items-center flex-column"id="input-quantity">
                            <div class="p-2  text-primary" id="remove"><b>Quantity</b></div>
                            <div class="input-group mt-2 border rounded border-primary" id="Quantity-input" style="overflow: hidden; height: 34px;">
                                <button class="btn no-hover" id="buttons" type="button" onclick="decrementQuantity('quantity_item2')">-</button>
                                <input id="quantity_item2" min="0" name="quantity" value="1" type="text" readonly
                                       class="form-control text-center outline-primary" style="width: 38px; border: none;">
                                <button class="btn no-hover" id="buttons" type="button" onclick="incrementQuantity('quantity_item2')">+</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-column" id="remove">
                            <div class="p-2  text-primary"id="remove"><b>Total</b></div>
                            <div class="p-2"><p class="mt-2">₱ 250.00 </p></div>    
                        </div>
                        <div class="d-flex flex-row align-items-center" id="trashbin">
                            <div class="p-4 d-flex align-items-left" id="trashbin">
                                <button type="button" class="btn" id="trashbin-main">
                                    <img src="{{ asset('images/trash3.svg') }}" class="mt-2">
                                </button>
                            </div>
                        </div>
                    </div>
 

                <!-- Select All and Checkout Section -->
                <div class="col-12 col-md-12 col-lg-12  col-xl-12 fixed-bottom">
                    <div class="container px-5 py-3 bg-white" id="fixed-bottom-div1">
                        <div class="col-12 mt-2">
                        <div class="align-items-center" id="fixed-bottom-div4">
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)" class="form-check-input border border-primary checkbox-all">
                                <label class="fs-3 fw-bold mb-0 ms-1">Select All (<span id="selectAll-count" class="fs-2">2</span>)</label>
                            </div>
                        </div>
                        <hr class="hr-fixed">
                        <!-- No. of Items and Total Section -->
                        <div class="d-flex justify-content-between align-items-center px-4" id="fixed-bottom-div2">
                            <!-- Item count display -->
    
                            <div class="col-2  fs-4 fw-bold" id="items-display">No. of Items: <span id="item-count" class="fw-bold fs-4 text-primary">0</span> item(s)</div>
                            <!-- Total amount display -->
                            <div>
                                <span class="ms-5 fw-bold fs-4 col-6" id="total-info">TOTAL: ₱ <span id="total-amount" class="fs-4 text-primary">0</span>.00</span>
                            </div>
                            <!-- Proceed to Checkout button -->
                            <div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalProceed" class="btn btn-primary btn-md" id="button-size">
                                    Proceed To Checkout
                                    <img src="{{ asset('images/cart3.svg') }}" class="mb-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>

    <!-- Modal for Proceed to Checkout -->
    @include('user.modal.checkoutProceed')
@endsection
