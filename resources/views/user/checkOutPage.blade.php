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


                        @php
                            $totalRetailPrice = 0;
                            $total_items = 0;
                        @endphp

                    @foreach($ShirtItems as $item)
                            @php
                                $totalRetailPrice += $item->retail_price * $item->quantity;
                                $total_items += $item->quantity;
                        @endphp
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="remove">₱ {{ number_format($item->supplier_price, 2) }}</td>
                            <td>Large</td>
                            <td>x{{ $item->quantity }}</td>
                            <td>₱ {{ number_format($item->retail_price, 2) }}</td>
                        </tr>
                    @endforeach

                    @foreach($OtherItems as $item)
                        @php
                            $totalRetailPrice += $item->retail_price * $item->quantity;
                            $total_items += $item->quantity;
                        @endphp
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="remove">₱ {{ number_format($item->supplier_price, 2) }}</td>
                            <td>Large</td>
                            <td>x{{ $item->quantity }}</td>
                            <td>₱ {{ number_format($item->retail_price, 2) }}</td>
                        </tr>
                    @endforeach
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
                                    No. of Items: <span class="fw-normal fs-4 checkout-sizes">{{$total_items}} <span class="fw-normal fs-4 checkout-sizes">item(s)</span></span>
                                </p>
                            </div>

                            <!-- Total amount display -->
                            <div class="col-6 mt-2 d-flex justify-content-center items-pay">
                                <p class="fw-bold my-2 fs-4 text-primary checkout-sizes">
                                    Total Payment: <span class="fw-normal fs-4 checkout-sizes">₱ <span class="fw-normal fs-4 checkout-sizes" id="total_amount">{{ number_format($totalRetailPrice, 2) }}</span></span>
                                </p>
                            </div>
                        </div>

                       
                        @foreach($productIds as $id)
                            @php
                                $productIdsString = implode(',', $productIds);
                            @endphp
                        @endforeach

                         <!-- Proceed to Checkout button -->
                        <div class="d-flex justify-content-end flex-row mt-1 items-btn">
                            <a href="{{ route('cartPage') }}" class="btn btn-outline-primary btn-md me-1 checkout-sizes">Cancel</a>
                            <a href="{{ route('paymentPage.i', ['id' => base64_encode($productIdsString)]) }}"
                                class="btn btn-primary btn-md checkout-sizes"
                                id="Update_total_amount"
                                style="width: 150px;"
                                onclick="updateTotalAmount()">
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

<script>
    function updateTotalAmount() {
        let totalRetailPrice = parseFloat(document.getElementById('total_amount').innerText.replace('₱ ', '').replace(/,/g, ''));

        fetch('/update-total-amount', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    totalRetailPrice: totalRetailPrice
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Total amount updated:", data.total_amount);
                } else {
                    console.log("Failed to update total amount.");
                }
            })
            .catch(error => console.error("Error:", error));
    }
</script>
@endsection