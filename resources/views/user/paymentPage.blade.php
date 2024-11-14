@extends('layouts.app')

@section('content')
<script src="{{ asset('js/cart.js') }}"></script>

<div class="container pt-4  ">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-11 w-75">
            <div class="d-flex justify-content-start align-items-center mb-2">
                <img src="{{ asset('images/credit-card.svg') }}" class="cart-logo mb-2">
                <h1 class="ms-1 text-primary fs-6 fw-bold">Payment</h1>
            </div>
            @foreach($shopName as $shop)
            @php
            $shops = "";
            $shops = $shop->shop_name;
            @endphp
            @endforeach

            @foreach($total_amount_toPay as $total)
            @php
            $amount_to_pay = $total->total_amount;
            @endphp
            @endforeach
            <!------- Sample data ------->
            <div class="container mt-2">
                <div class="card border border-primary p-3">
                    <div class="card-body">
                        <form>
                            <div class="mb-2">
                                <label for="paymentMode" class="form-label fs-4">
                                    <span class="fs-5 fw-bold text-primary">Mode Of Payment: </span> GCash
                                </label>
                            </div>
                            <p class="fs-4">Please ensure that you make a payment of <span class="fw-bolder text-primary fs-3"><span class="fs-4 text-primary fw-bold"> ₱ </span>{{ number_format($amount_to_pay, 2) }}</span> to <span class="fw-bolder text-primary fs-3">{{ $shops}}</span>, and remember to provide accurate information.</p>

                            <div class="mb-3">
                                <label for="gcashNumber" class="form-label fw-bold">Pay to this GCash Number:</label>
                                <select class="form-select" id="gcashNumber">
                                    @foreach($gcashInfo as $gcash)
                                    <option value="{{ $gcash->id }}"
                                        @if($gcash->gcash_limit == 0)
                                        class="text-danger" disabled @endif >

                                        @if($gcash->gcash_limit == 0)
                                            @php
                                                $nameParts = explode(' ', $gcash->gcash_name);
                                                $firstName = isset($nameParts[0]) ? $nameParts[0] : '';
                                                $middleInitial = isset($nameParts[1]) ? $nameParts[1] : ''; // Handles case where there's no middle initial
                                                $lastName = isset($nameParts[2]) ? $nameParts[2] : $nameParts[1]; // Handles case where there's no surname
                                            @endphp
                                                {{ $gcash->gcash_number }} - *not available for payment*
                                        @else
                                            @php
                                                $nameParts = explode(' ', $gcash->gcash_name);
                                                $firstName = $nameParts[0];
                                                $middleInitial = isset($nameParts[1]) ? $nameParts[1] : ''; // Handles case where there's no middle initial
                                                $lastName = isset($nameParts[2]) ? $nameParts[2] : $nameParts[1]; // Handles case where there's no surname
                                            @endphp
                                                {{ $gcash->gcash_number }} - {{ substr($firstName, 0, 3) }}** {{ substr($middleInitial, 0, 1) }}* {{ substr($lastName, 0, 3) }}**
                                        @endif
                                    </option>
                                    @endforeach

                                    <style>
                                        option[disabled] {
                                            color: red;
                                            ;
                                            /* Optional: Set a light red background */
                                        }
                                    </style>

                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="referenceNumber" class="form-label fw-bold">Reference Number</label>
                                <input type="text" class="form-control fs-3" id="referenceNumber" placeholder="Enter reference number" required>
                            </div>

                            <div class="mb-3">
                                <label for="proofPayment" class="form-label fw-bold">Proof of Payment</label>
                                <input type="file" class="form-control" id="proofPayment" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                @foreach($productIds as $id)
                                @php

                                $productIdsString = implode(',', $productIds);

                                @endphp
                                @endforeach

                                <a href="{{ route('checkOutPage.Checkout-Items', ['encodedIds' => base64_encode($productIdsString)]) }}" id="cancelButton" class="btn btn-outline-primary me-1 payment-sizes">Cancel</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalProceedPayment" class="btn btn-primary payment-sizes">
                                    Confirm Payment
                                    <img src="{{ asset('images/credit-card.svg') }}" class="mb-1">
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.modal.checkpaymentinfo')
@endsection