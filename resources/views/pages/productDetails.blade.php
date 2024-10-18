@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--<div class="card-header">{{ __('Dashboard') }}</div>-->
                <div class="card-body clearfix">
                    <div class="product">
                    <div class="row justify-content-center d-flex align-items-center ">
                        <div class="col-md-6 mx-auto justify-content-center d-flex">
                            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 400px !important; height: 500px !important; border-radius:5px">
                        </div>
                        <div class="left col-md-6 mt-0 d-flex flex-column align-items-start">
                        <div class="mt-0 mx-auto justify-content-center">
                            <p class="status">CIRCUITS</p>
                            <p class="status">T-Shirt</p>
                            <p class="status">Pre-Order</p>
                            <p class="title fs-10 fw-bold mb-0">CirCUITS Lanyard</p>
                            <div class="ratings d-flex align-items-center mt-0">
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star mr-1"></i>
                                <p class="fs-4 mb-1 ml-2 mt-1">40 solds</p>
                            </div>
                        <p class="price fs-8 fw-bold mb-1">₱250.00</p>
                        <div class="quantity mb-5">
                        <p class="quantity-text mb-1 mt-3" style="color: #092C4C">Quantity</p>
                        <div class="quantity-selector" style="height:35px; width:80px">
                            <button id="decrement" style="color: #092C4C">-</button>
                            <input type="text" id="quantity" value="1" readonly style="color: #092C4C">
                            <button id="increment" style="color: #092C4C">+</button>
                            </div>
                        </div>
                        <div style="margin-top: 5rem;">
                            <img src="{{asset('images/chat.svg')}}" class="chat-icon mr-3 ml-2" style="width:22px; height:22px">
                            <!-- Add to Cart Button -->
                            <button class="btn btn-primary ml-4 fw-medium" style="width:130px; height:48px" data-toggle="modal" data-target="#exampleModalCenter">
                                <img src="{{asset('images/cart.svg')}}" class="mr-1" style="width:15px; height:15px"> Add to Cart
                            </button>
                            <!-- Buy Now Button -->
                            <button class="btn btn-secondary ml-2 fw-medium" style="width:130px; height:48px; color:white" data-toggle="modal" data-target="#exampleModalCenter">
                                <img src="{{asset('images/cart.svg')}}" class="mr-1" style="width: 15px; height:15px"> Buy Now
                            </button>

                            </div>
                        </div>
                        </div>
                        
                    </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <h2 class="fs-9 fw-semibold mt-5" style="color: #092C4C">Details</h2>
                        <p class="fs-4 fw-medium ml-2" style="color: #092C4C">Circuits T-shirt</p>
                        <ul class="ml-5">
                        <li class="mb-2">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis. Nibh tincidunt enim vitae scelerisque pellentesque. Urna fames bibendum fames nisl et</li>
                        <li class="mb-2">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis</li>
                        <li class="mb-2">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor </li>
                        </ul>
                    </div>
                    <div class="row justify-content-center">
                        <h2 class="fs-9 fw-semibold mt-5" style="color: #092C4C">Customer Reviews</h2>
                        <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                                    <div class="p-2 mt-2"><span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span></div>
                                    <div class="comment-text w-100">
                                        <p class="fs-4 mt-3">Juan Dela Cruz<span class="date fs-3 mr-3" style="float:right;">April 14, 2019</span></p>
                                        <p class="mt-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</p>
                                    </div>
                        </div>
                        <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                                    <div class="p-2 mt-2"><span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span></div>
                                    <div class="comment-text w-100">
                                        <p class="fs-4 mt-3">Juan Dela Cruz<span class="date fs-3 mr-3" style="float:right;">April 14, 2019</span></p>
                                        <p class="mt-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</p>
                                    </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <h2 class="fs-9 fw-semibold mt-5" style="color: #092C4C">You may also like</h2>
                        <div class="row row-cols-1 row-cols-md-6 g-4">
                            <div class="flex-fill mx-2" >
                                <div class="card-product h-80">
                                    <img src="{{ asset('images/sample.jpg') }}" class="card-img-top mt-2" alt="Product Image">
                                        <p class="card-text-status" >CIRCUITS</p>
                                        <h5 class="card-title">CirCUITS T-Shirt</h5>
                                        <p class="card-text">₱250.00</p>
                                        <div class="ratings-below d-flex align-items-center mt-0">
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <p class="fs-1 mb-1 ml-2 mt-1">40 solds</p>
                                        </div>
                                        <a href="#" class="btn btn-primary fs-2 d-flex align-items-center">
                                            <img src="{{ asset('images/arrow.svg') }}" class="me-2" style="width: 10px; height: 10px;" alt="Arrow Icon">
                                            View Details
                                        </a>
                                </div>
                            </div>
                            <div class="flex-fill mx-2" >
                                <div class="card-product h-100">
                                    <img src="{{ asset('images/sample.jpg') }}" class="card-img-top mt-2" alt="Product Image">
                                        <p class="card-text-status">CSC</p>
                                        <h5 class="card-title">CSC Lanyard</h5>
                                        <p class="card-text">₱150.00</p>
                                        <div class="ratings-below d-flex align-items-center mt-0">
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <p class="fs-1 mb-1 ml-2 mt-1">40 solds</p>
                                        </div>
                                        <a href="#" class="btn btn-primary fs-2 d-flex align-items-center">
                                            <img src="{{ asset('images/arrow.svg') }}" class="me-2" style="width: 10px; height: 10px;" alt="Arrow Icon">
                                            View Details
                                        </a>
                                </div>
                            </div>
                            <div class="flex-fill mx-2" >
                                <div class="card-product h-100">
                                    <img src="{{ asset('images/sample.jpg') }}" class="card-img-top mt-2" alt="Product Image">
                                        <p class="card-text-status" >CIRCUITS</p>
                                        <h5 class="card-title">CirCUITS T-Shirt</h5>
                                        <p class="card-text">₱250.00</p>
                                        <div class="ratings-below d-flex align-items-center mt-0">
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <p class="fs-1 mb-1 ml-2 mt-1">40 solds</p>
                                        </div>
                                        <a href="#" class="btn btn-primary fs-2 d-flex align-items-center">
                                            <img src="{{ asset('images/arrow.svg') }}" class="me-2" style="width: 10px; height: 10px;" alt="Arrow Icon">
                                            View Details
                                        </a>
                                </div>
                            </div>
                            <div class="flex-fill mx-2">
                                <div class="card-product h-100">
                                    <img src="{{ asset('images/sample.jpg') }}" class="card-img-top mt-2" alt="Product Image">
                                        <p class="card-text-status" >CSC</p>
                                        <h5 class="card-title">CSC Lanyard</h5>
                                        <p class="card-text">₱150.00</p>
                                        <div class="ratings-below d-flex align-items-center mt-0">
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star rating-color2 mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <p class="fs-1 mb-1 ml-2 mt-1">40 solds</p>
                                        </div>
                                        <a href="#" class="btn btn-primary fs-2 d-flex align-items-center">
                                            <img src="{{ asset('images/arrow.svg') }}" class="me-2" style="width: 10px; height: 10px;" alt="Arrow Icon">
                                            View Details
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Modal -->
<div class="modal fade md-8" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" style="color: #092C4C">
            <img src="{{asset('images/warning.svg')}}" ><h5 class="modal-title fs-5 fw-semibold ml-3">ADD ITEM?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            This product belongs to another store. Adding it will empty your cart. Would you like to proceed?
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Anyway</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const quantityInput = document.getElementById('quantity');

        let quantity = parseInt(quantityInput.value);

        incrementButton.addEventListener('click', () => {
            quantity++;
            quantityInput.value = quantity;
            if (quantity > 1) {
                decrementButton.disabled = false;
            }
        });

        decrementButton.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
            }
            if (quantity === 1) {
                decrementButton.disabled = true;
            }
        });

        // Disable decrement button initially since quantity is 1
        if (quantity === 1) {
            decrementButton.disabled = true;
        }
    </script>
@endsection
