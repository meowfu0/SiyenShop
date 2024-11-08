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
                                <p class="fs-4">Please ensure that you make a payment of <span class="fw-bolder text-primary fs-3">₱ 600.00</span> to <span class="fw-bolder text-primary">CirCUITS</span>, and remember to provide accurate information.</p>

                                <div class="mb-3">
                                    <label for="gcashNumber" class="form-label fw-bold">Pay to this GCash Number:</label>
                                    <select class="form-select" id="gcashNumber">
                                        <option value="09123456789 - ST**P CU**Y">09123456789 - ST**P CU**Y</option>
                                        <option class="text-danger" value="09123456789 - ST**P CU**Y">09123456789 - *not available</option>
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
                                    <a href="{{ route('checkOutPage') }}" class="btn btn-outline-primary me-1 payment-sizes">Cancel</a>
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
