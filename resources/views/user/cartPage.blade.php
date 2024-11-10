@extends('layouts.app')

@section('content')
<meta http-equiv="refresh" content="20"> <!-- Refreshes the page every 20 seconds -->
    <script src="{{ asset('js/cart.js') }}"></script>
    
  <div class="d-flex justify-content-start align-items-center mb-2 container pt-3">  
                    <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                    <h1 class="ms-1 text-primary fw-bold">Cart</h1>
                </div>
                
<div class="container" style="min-height: calc(180vh - 80px); overflow-y: auto;">
    <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12  col-md-12 col-lg-12  col-xl-12 ">
                
            @if($ShirtItems->isEmpty() && $OtherItems->isEmpty())
                 <div class="d-flex flex-row justify-content-center align-items-center mt-5">
                      <p class="fs-5">No items in the cart</p>
                </div>
            @else

    <?php $id = 1; ?>

    <!-- LOOP FOR Shirt Items only  -->
    @foreach($ShirtItems as $item)

        <div class="card-body d-flex justify-content-between border border-2 rounded-3 border-grey p-2 mb-2" id="main-card">
            <div class="d-flex flex-row align-items-center">
                <div class="p-4 d-flex align-items-left" id="form-check">
                    <input type="checkbox" class="form-check-input border border-primary checkboxs" onclick="AddCheckedProducts()" id="checkbox-{{ $id }}" value="{{ number_format($item->retail_price, 2) }}">
                </div>
                        <div>
                              <img src="{{ asset('images/' . $item->product_image) }}" class="img-fluid rounded-2 img-items">
                        </div>
            </div>

            <div class="d-flex align-items-start flex-row justify-content-between gap-5" id="ProductName">
                <div class="d-flex align-items-start flex-column">
                    <div class="p-2 text-primary" id="remove"><b>Item</b></div>
                    <div class="p-2 fixed-width" id="prod-name"><p class="mt-2 text-primary fs-4" id="name">{{ $item->product_name }}</p></div>
                </div>

                <div class="d-flex align-items-start flex-row gap-5" id="Price-Variant">
                    <div class="d-flex align-items-center flex-column">
                        <div class="p-2 text-primary" id="remove"><b>Unit Price</b></div>
                        <div class="p-2" id="amount"><p class="price mt-2 text-primary">₱ {{ number_format($item->supplier_price, 2) }}</p></div>
                    </div>

                    <div class="d-flex align-items-center flex-column">
                        <div class="p-2 text-primary" id="remove"><b>Variant/Size</b></div>
                        <div class="p-2 text-primary">
                            <select class="form-select border border-primary size-input text-primary">
                                @foreach(['S', 'M', 'L', 'XL'] as $sizeOption)
                                    @php
                                        $sizeExists = $sizes->contains('size', $sizeOption);
                                    @endphp
                                    <option class="text-primary" value="{{ $sizeOption }}" {{ !$sizeExists ? 'disabled' : '' }}>
                                        @switch(strtolower($sizeOption))
                                            @case('l') Large @break
                                            @case('xl') X-Large @break
                                            @case('m') Medium @break
                                            @case('s') Small @break
                                            @default {{ $sizeOption }}
                                        @endswitch
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center flex-column" id="input-quantity">
                <div class="p-2 text-primary" id="remove"><b>Quantity</b></div>
                <div class="input-group mt-2 border rounded border-primary" id="Quantity-input" style="overflow: hidden; height: 34px;">
                    <button class="btn no-hover text-primary" id="buttons" type="button" onclick="decrementQuantity('quantity_{{ $id }}')">-</button>
                    <input id="quantity_{{ $id }}" min="0" name="quantity" value="{{ $item->quantity }}" type="text" readonly class="form-control text-center outline-primary quantities text-primary" style="width: 38px; border: none;">
                    <button class="btn no-hover text-primary" id="buttons" type="button" onclick="incrementQuantity('quantity_{{ $id }}')">+</button>
                </div>
            </div>

            <div class="d-flex align-items-center flex-column" id="remove">
                <div class="p-2 text-primary" id="remove"><b>Total</b></div>
                <div class="p-2"><p class="mt-1 text-primary">₱ {{ number_format($item->retail_price, 2) }}</p></div>
            </div>

            <div class="d-flex flex-row align-items-center" id="trashbin">
                <div class="p-4 d-flex align-items-left" id="trashbin">
                    <button type="button" class="btn" id="trashbin-main" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $id }}" data-id="{{ $item->id }}">
                        <img src="{{ asset('images/trash3.svg') }}" class="mt-1">
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center flex-column text-center">
                        <img src="{{ asset('images/check.png') }}" style="height: 70px; width:70px; display:none;" alt="Cart Logo">
                        <p class="fw-semibold fs-5 mt-3">Are you sure you want to remove this item?</p>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary remove-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger remove btn" data-id="{{ $item->id }}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- increment id value -->
        <?php $id++; ?>
    @endforeach

    <!-- LOOP FOR Other Items  like lanyard , etc -->
    @foreach($OtherItems as $item)
        <div class="card-body d-flex justify-content-between border border-2 rounded-3 border-grey p-2 mb-2" id="main-card">
            <div class="d-flex flex-row align-items-center">
                <div class="p-4 d-flex align-items-left" id="form-check">
                    <input type="checkbox" class="form-check-input border border-primary checkboxs" onclick="AddCheckedProducts()" id="checkbox-{{ $id }}" value="{{ number_format($item->retail_price, 2) }}">
                </div>
                <div>
                    <img src="{{ asset('images/' . $item->product_image) }}" class="img-fluid rounded-2 img-items">
                </div>
            </div>

            <div class="d-flex align-items-start flex-row justify-content-between gap-5" id="ProductName">
                <div class="d-flex align-items-start flex-column">
                    <div class="p-2 text-primary" id="remove"><b>Item</b></div>
                    <div class="p-2 fixed-width" id="prod-name"><p class="mt-2 text-primary fs-4" id="name">{{ $item->product_name }}</p></div>
                </div>

                <div class="d-flex align-items-start flex-row gap-5" id="Price-Variant">
                    <div class="d-flex align-items-center flex-column">
                        <div class="p-2 text-primary" id="remove"><b>Unit Price</b></div>
                        <div class="p-2"><p class="price mt-2 text-primary">₱ {{ number_format($item->supplier_price, 2) }}</p></div>
                    </div>

                    <div class="d-flex align-items-center flex-column">
                        <div class="p-2 text-primary" id="remove"><b>Variant/Size</b></div>
                        <div class="p-2">
                            <select class="form-select border border-primary size-input text-primary">
                                <option selected>none</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center flex-column" id="input-quantity">
                <div class="p-2 text-primary" id="remove"><b>Quantity</b></div>
                <div class="input-group mt-2 border rounded border-primary" id="Quantity-input" style="overflow: hidden; height: 34px;">
                    <button class="btn no-hover text-primary" id="buttons" type="button" onclick="decrementQuantity('quantity_{{ $id }}')">-</button>
                    <input id="quantity_{{ $id }}" min="0" name="quantity" value="{{ $item->quantity }}" type="text" readonly class="form-control text-center outline-primary text-primary quantities" style="width: 38px; border: none;">
                    <button class="btn no-hover text-primary" id="buttons" type="button" onclick="incrementQuantity('quantity_{{ $id }}')">+</button>
                </div>
            </div>

            <div class="d-flex align-items-center flex-column" id="remove">
                <div class="p-2 text-primary" id="remove"><b>Total</b></div>
                <div class="p-2"><p class="mt-1 text-primary">₱ {{ number_format($item->retail_price, 2) }}</p></div>
            </div>

            <div class="d-flex flex-row align-items-center" id="trashbin">
                <div class="p-4 d-flex align-items-left" id="trashbin">
                    <button type="button" class="btn" id="trashbin-main" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $id }}" data-id="{{ $item->id }}">
                        <img src="{{ asset('images/trash3.svg') }}" class="mt-1">
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center flex-column text-center">
                        <img src="{{ asset('images/check.png') }}" style="height: 70px; width:70px; display:none;" alt="Cart Logo">
                        <p class="fw-semibold fs-5 mt-3">Are you sure you want to remove this item?</p>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-outline-secondary remove-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger remove btn" data-id="{{ $item->id }}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $id++; ?>
    @endforeach
@endif
                 
                <!-- Select All and Checkout Section -->
                <!------------AAYUSIN PA ITO FOR MOBILE RESPONSIVE--------->
                <div class="col-12 col-md-12 col-lg-12  col-xl-12 fixed-bottom">
                    <div class="container px-5 pt-1 pb-3 bg-white shadow-sm  rounded-2" id="fixed-bottom-div1">
                        <div class="col-12 mt-2">
                        <div class="align-items-center" id="fixed-bottom-div4">
                        <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)" class="form-check-input border border-primary checkbox-all">
                        <label class="fs-3 fw-bold mb-0 ms-1 text-primary">Select All (<span id="selectAll-count" class="fs-3">0</span>)</label>
                            </div>
                        </div>
                        <hr class="hr-fixed">
                        <!-- No. of Items and Total Section -->
                        <div class="d-flex justify-content-between align-items-center px-4" id="fixed-bottom-div2">
                            <!-- Item count display -->
                            <div class="d-flex row col-9 justify-content-between" id="items-total">
                                <div class="col-4" id="items-count-div">
                                    <p class="mt-3 fw-bold fs-4 text-primary footer-fs">No. of Items: <span id="item-count" class="fs-4 fw-normal text-primary">0</span><span class="fs-4 fw-normal text-primary" > item(s)</span> </p>
                                </div>
                                <div class="col-5" id="total-div"> <!-- Total amount display -->
                                     <p class="mt-3 fw-bold fs-4 text-primary footer-fs" >TOTAL: <span class="fw-normal fs-4">₱ </span><span id="total-amount" class="fs-4 fw-normal text-primary">0.00</span></p>
                                </div>
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
