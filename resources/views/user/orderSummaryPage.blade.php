@extends('layouts.app')

@section('content')
<script src="{{ asset('js/cart.js') }}"></script>

<div class="container pt-4 " style="min-height: calc(180vh - 80px); overflow-y: auto;">

    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-11">
            <!-- Order Review Header -->

            <div class="d-flex justify-content-start align-items-center mb-2">
                <img src="{{ asset('images/cart.svg') }}" class="cart-logo mb-2">
                <h1 class="ms-1 text-primary fs-6 fw-bold">Order Review</h1>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif


            <!-- Order Review Table -->
            <div class="border rounded-3 border-primary table-responsive">
                <table class="table border-primary mt-2 p-2">
                    <thead class="table-head" id="table-data">
                        <tr class="fw-bold fs-4">
                            <th class="text-primary">Item</th>
                            <th class="text-primary remove">Unit Price</th>
                            <th class="text-primary">Variant/Size</th>
                            <th class="text-primary">Quantity</th>
                            <th class="text-primary">Item Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="noBorder" id="order-data">

                        @foreach($OrderDetails as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="remove">₱ {{ number_format($item->retail_price, 2) }}</td>

                            <td>
                                @if(is_null($item->variant_size))
                                None <!-- Display 'None' if size is NULL -->
                                @elseif($item->variant_size == 'L' || $item->variant_size == 'l')
                                Large
                                @elseif($item->variant_size == 'S' || $item->variant_size == 's')
                                Small
                                @elseif($item->variant_size == 'M' || $item->variant_size == 'm')
                                Medium
                                @elseif($item->variant_size == 'XL' || $item->variant_size == 'xl')
                                X-Large
                                @else
                                {{ $item->variant_size }}
                                @endif
                            </td>

                            <td>x{{ $item->quantity }}</td>
                            <td> ₱ {{ number_format($item->retail_price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-start align-items-center mb-1 mt-3   ">
                <img src="{{ asset('images/credit-card.svg') }}" class="cart-logo mb-2">
                <h1 class="ms-1 text-primary fs-6 fw-bold">Transactions</h1>
            </div>


            <div class="container mt-2 rounded-3" id="order-container">
                <div class="row border border-primary rounded-3" style="height: 150px;" id="receiver-sender">
                    <div class="col-md-6 p-4 border-left" style="height: 149px;" id="remove-border">
                        <h4 class="ms-5 fw-bold text-primary fs-5">GCash Receiver</h4>
                        <ul class="list-unstyled mt-4 ms-5">
                            <li><strong class="text-primary">Mode of Payment:</strong> <span class="ps-5 fs-3">GCash</span></li>
                            @foreach($gcashInfo as $gcash)
                            <li><strong class="text-primary">Org GCash No#:</strong> <span class="ps-5 ms-2 fs-3">{{$gcash->gcash_number}}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 p-3 border border-primary rounded-3" id="add-border">
                        <h4 class="ms-5 fw-bold text-primary mt-1 fs-5">GCash Sender</h4>
                        <ul class="list-unstyled mt-3 ms-5">
                            <li><strong class="text-primary">Shop Name:</strong> <span class="ps-5 fs-3 ms-5">{{$item->shop_name}}</span></li>
                            <li><strong class="text-primary">No.of Items:</strong> <span class="ps-5 fs-3 ms-5">{{$item->total_items}}</span> item(s)</li>
                            <li>
                                <strong class="text-primary">Proof of Payment:</strong>
                                <span class="ps-5 ms-2">
                                    <!-- Proof of Payment Image modal-->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewProof" class="fs-2 ">Proof of Payment Image</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Checkout Section -->
            <div class="col-12 fixed-bottom">
                <div class="container px-5  pb-3 bg-white">
                    <div class="col-12 mt-2">

                        <hr class="hr-fixed">

                        <div class="d-flex justify-content-between align-items-center px-5" id="order-footer">
                            <div class="col-2 m-0 p-0 w-25" id="order-width">
                                <p class="fw-bolder text-primary mb-0">Ref No. : <span class="fw-normal fs-3 "> {{ ($item->reference_number) }}</span></p>
                                <p class="fw-bolder text-primary mb-0">Order Date: <span class="fw-normal fs-3">{{ \Carbon\Carbon::parse($item->order_date)->format('m-d-Y h:i:s A') }}</span></p>

                            </div>

                            <div class="mt-2 w-25" id="order-width">
                                <p class="fs-4">
                                    <span class=" fw-bolder col-6 fs-4 text-primary ">Total Payment:</span>
                                    <span class="fs-4">₱ {{ number_format($item->total_amount, 2) }}</span>
                                </p>
                            </div>

                            <!-- Proceed to Checkout button -->
                            <div class="d-flex justify-content-end">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalConfirmed" class="btn btn-primary btn-md" style="width: 250px;">
                                    Confirm Order
                                    <img src="{{ asset('images/cart3.svg') }}" class="mb-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Proof of Payment Modal -->
    <div class="modal fade " id="viewProof" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body d-flex justify-content-center p-0">
                    <img src="{{ asset('storage/GcashReceipts/' . $item->proof_of_payment) }}" alt="Proof of Payment" class="img-fluid w-75">
                </div>
            </div>
        </div>
    </div>

    @include('user.modal.checkoutConfirmation')
    @endsection