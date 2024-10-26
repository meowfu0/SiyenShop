@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body clearfix">
                <div class="row justify-content-center d-flex align-items-stretch">
                    <!-- Left Column for Image -->
                    <div class="col-md-5 d-flex align-items-start justify-content-center">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 400px !important; height: 100% !important; border-radius:5px">
                    </div>
                    <!-- Right Column for Details -->
                    <div class="col-md-5 d-flex flex-column justify-content-start">
                        <div class="mx-auto justify-content-start">
                            <p class="status">CIRCUITS</p>
                            <p class="status">T-Shirt</p>
                            <p class="status">Pre-Order</p>
                            <p class="title fs-10 fw-bold mb-0">CirCUITS Lanyard</p>
                            <div class="ratings d-flex align-items-center gap-3">
                                <div>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                </div>
                                <p class="fs-4 mb-1 ml-2 mt-1">40 sold</p>
                            </div>
                            <p class="price fs-8 fw-bold mb-1">₱250.00</p>
                            <div class="quantity mb-4" style="margin-top: 150px;">
                                <p class="quantity-text mb-1 mt-3" style="color: #092C4C">Quantity</p>
                                <div class="quantity-selector" style="height:35px; width:80px">
                                    <button id="decrement" style="color: #092C4C">-</button>
                                    <input type="text" id="quantity" value="1" readonly style="color: #092C4C">
                                    <button id="increment" style="color: #092C4C">+</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center w-100" style="margin-top: 5rem;">
                                <img src="{{ asset('images/chat.svg') }}" class="chat-icon"
                                    style="width:22px; height:22px">
                                <!-- Add to Cart Button -->
                                <button class="btn btn-primary fw-medium d-flex align-items-center justify-content-center gap-2" style="width:130px; height:48px"
                                    data-toggle="modal" data-target="#exampleModalCenter">
                                    <img src="{{ asset('images/cart.svg') }}" class="invert"
                                        style="width:15px; height:15px"> Add to Cart
                                </button>
                                <!-- Buy Now Button -->
                                <button class="btn btn-secondary fw-medium d-flex align-items-center justify-content-center gap-2"
                                    style="width:130px; height:48px; color:white" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <img src="{{ asset('images/cart.svg') }}" class="invert"
                                        style="width: 15px; height:15px"> Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

<!--2nd row-->
                    <div class="row col-md-12 justify-content-center">
                        <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">Details</h2>
                        <p class="fs-4 fw-medium ml-5" style="color: #092C4C">Circuits Lanyard</p>
                        <ul class="ml-5">
                        <li class="mb-2 ml-5">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis. Nibh tincidunt enim vitae scelerisque pellentesque. Urna fames bibendum fames nisl et</li>
                        <li class="mb-2 ml-5">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis</li>
                        <li class="mb-2 ml-5">Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor </li>
                        </ul>
                    </div>
                        <div class="row col-md-12 justify-content-center">
                        <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">Customer Reviews
                            <span class="fs-4"><a href="{{url('customerReview')}}" style="float:right; text-decoration:none; color: #092C4C; margin-top: 10px">See all</a></span>
                        </h2>
                        <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                            <div class="p-2 mt-2">
                                <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                            </div>
                            <div class="comment-text w-100">
                                <!-- Name and date -->
                                <p class="fs-4 mt-3 mb-1">Juan Dela Cruz
                                    <span class="date fs-3 mr-3" style="float:right;">April 14, 2019</span>
                                </p>
                                <div class="ratings-below" style="margin-top: -5px;">
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                </div>
                                <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</p>
                            </div>
                        </div>
                        <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                            <div class="p-2 mt-2">
                                <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                            </div>
                            <div class="comment-text w-100">
                                <!-- Name and date -->
                                <p class="fs-4 mt-3 mb-1">Juan Dela Cruz
                                    <span class="date fs-3 mr-3" style="float:right;">April 14, 2019</span>
                                </p>
                                <div class="ratings-below" style="margin-top: -5px;">
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star rating-color2 mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                </div>
                                <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row col-md-12 justify-content-center">
                    <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">You may also like</h2>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gap-5 justify-content-center">
                        <div class="block-7 pd">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">CIRCUITS</div>
                                <span class="excerpt d-block">CirCUITS Stickers</span>
                                <span class="price"><span class="number">₱10.00</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">49 solds</span>          
                                </div>
                                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                            </div>
                        </div>

                        <div class="block-7">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">CIRCUITS</div>
                                <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                <span class="price"><span class="number">₱250.00</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">17 solds</span>          
                                </div>
                                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                            </div>
                        </div>

                        <div class="block-7">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">CIRCUITS</div>
                                <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                <span class="price"><span class="number">₱250.00</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">20 solds</span>          
                                </div>
                                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                            </div>
                        </div>

                        <div class="block-7"><img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">CIRCUITS</div>
                                <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                <span class="price"><span class="number">₱250.00</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">59 solds</span>          
                                </div>
                                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                            </div>
                        </div>

                        <div class="block-7">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">CIRCUITS</div>
                                <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                <span class="price"><span class="number">₱250.00</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">40 solds</span>          
                                </div>
                                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>

                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>               
</div>
<!-- Modal -->
<div class="modal fade md-6" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content p-2">
            <div class="modal-header text-center d-flex justify-content-between" style="color: #092C4C">
                <div class="d-flex">
                    <img src="{{asset('images/warning.svg')}}" class="me-2"><h5 class="modal-title fs-5 fw-semibold ml-3">ADD ITEM?</h5>
                </div>
                
                <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px">&times;</span>
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