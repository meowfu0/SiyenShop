@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body clearfix">
                    <div class="row justify-content-center d-flex align-items-stretch">
                    
                    <!-- Left Column for Image -->
                    <div class="col-md-5 d-flex align-items-start justify-content-center">
                       
                        <img 
                        src="{{ Storage::exists('public/' . $product->product_image) ? Storage::url('public/' . $product->product_image) :  asset('images/sample.jpg') }}" 
                        class="img-fluid" 
                        style="width: 400px !important; height: 100% !important; border-radius:5px"
                    />
                    
                    </div>
                    
                    <!-- Right Column for Details -->
                     
                    <div class="col-md-5 d-flex flex-column justify-content-start">
                        <div class="mx-auto justify-content-start">
                            <p class="status">{{$product->organization->shop_name}}</p>
                            <p class="status">{{$product->category->category_name}}</p>
                            <p class="status">{{$product->status->status_name}}</p>
                            <p class="title fs-10 fw-bold mb-0">{{$product->product_name}}</p>
                            <div class="ratings d-flex align-items-center gap-3">
                                <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star{{ $i <= floor($averageRating) ? ' rating-color' : '' }}"></i>
                                @endfor
                                </div>
                                <p class="fs-4 mb-1 ml-2 mt-1">{{$product->sales_count}} sold</p>
                            </div>
                            <p class="price fs-8 fw-bold mb-1">₱{{number_format($product->retail_price, 2)}}</p>

                        @if ($variants->isNotEmpty())
                        <div class="size-variation">
                            <p class="size mb-1 mt-4" style="color: #092C4C">Size</p>
                        
                            @foreach ($variants as $index => $variant)
                                <!-- Radio button to select a size -->
                                <input type="radio" class="btn-check ms-1" name="btnradio" id="btnradio{{$index}}" autocomplete="off"
                                       {{ $loop->first ? 'checked' : '' }} value="{{$variant->id}}" 
                                       onclick="document.getElementById('size').value = {{$variant->id}}">
                                <label class="btn btn-outline-primary" for="btnradio{{$index}}">{{$variant->size}}</label>
                            @endforeach
                        </div>
                        
                            @endif
                            
                            <div class="quantity mb-4" style="margin-top: 150px;">
                                @if($product->status->status_name === 'onhand')
                                    <p class="fs-4 pt-1">Stocks left: <b>{{ $product->stocks }}</b></p>
                                @endif

                                <p class="quantity-text mb-1 mt-3" style="color: #092C4C">Quantity</p>
                                <div class="quantity-selector" style="height:35px; width:80px">
                                    <button type="button" id="decrement" style="color: #092C4C">-</button>
                                    <input type="text" id="selectorQuantity" value="1" readonly style="color: #092C4C">
                                    <button type="button" id="increment" style="color: #092C4C">+</button>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center w-100" style="margin-top: 5rem;">
                                <img src="{{ asset('images/chat.svg') }}" class="chat-icon" style="width:22px; height:22px" id="chatIcon" data-shop-id="{{ $product->organization->id }}" data-shop-name="{{ $product->organization->shop_name }}">
                                <!-- Add to Cart Button -->
                                <form action="{{ route('productDetails.addToCart') }}" method="POST" id="addToCartForm">
                                    @csrf
                                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                                    <input type="number" class="quantity d-none" name="quantity" value="1">
                                    @if ($variants->isNotEmpty())
                                    <input type="number" id="size" name="size" value="{{ $variants->first()->id }}" class="d-none">
                                    @endif

                                    <button type="submit" 
                                        class="btn btn-primary fw-medium d-flex align-items-center justify-content-center gap-2"
                                        style="width:130px; height:48px">
                                        <img src="{{ asset('images/cart.svg') }}" class="invert" style="width:15px; height:15px"> 
                                        Add to Cart
                                    </button>
                                </form>
                                
                                <form action="{{ route('productDetails.buy') }}" method="POST" id="buyNow">
                                    @csrf
                                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                                    <input type="number" class="quantity d-none" name="quantity" value="1">
                                    @if ($variants->isNotEmpty())
                                    <input type="number" id="size" name="size" value="{{ $variants->first()->id }}" class="d-none">
                                    @endif
                                    <button type="submit" id="buyNowButton" class="btn btn-secondary fw-medium d-flex align-items-center justify-content-center gap-2"
                                        style="width:130px; height:48px; color:white">
                                        <img src="{{ asset('images/cart.svg') }}" class="invert" style="width: 15px; height:15px"> Buy Now
                                    </button>
                                </form>
                                <!-- Buy Now Button -->
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!--Details Section-->
                    <div class="row col-md-12 justify-content-center">
                        <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">Details</h2>
                        <p class="fs-4 fw-medium ml-5" style="color: #092C4C">{{$product->product_decription}}</p>
                    </div>
                        <div class="row col-md-12 justify-content-center">
                            <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">Customer Reviews
                                <span class="fs-4"><a href="{{route('customerReview', ['product_id' => $product->id])}}" style="float:right; text-decoration:none; color: #092C4C; margin-top: 10px">See all</a></span>
                            </h2>

                                <!-- Review Section-->
                            @foreach ($reviews as $review)
                                <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                                    <div class="p-2 mt-2">
                                        <span class="round"><img src="{{ asset('images/user.svg') }}" alt="user" width="25"></span>
                                    </div>
                                    <div class="comment-text w-100">
                                        <!-- Name and date -->
                                        <p class="fs-4 mt-3 mb-1">{{ $review->user->first_name }} {{ $review->user->last_name }}
                                            <span class="date fs-3 mr-3" style="float:right;">{{ $review->review_date }}</span>
                                        </p>
                                        <div class="ratings-below" style="margin-top: -5px;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star{{ $i <= $review->ratings ? ' rating-color2' : '' }} mr-1"></i>
                                            @endfor
                                        </div>
                                        <p class="mt-2">{{ $review->review_text }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

                <!-- You may also like -->
                <div class="row col-md-12 justify-content-center">
                    <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">You may also like</h2>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gap-5 justify-content-center">
                        @foreach ($relatedProducts as $relatedProduct)
                        <div class="block-7 pd">
                        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                            <div class="text-center p-4">
                                <div class="badge">{{$relatedProduct->organization->shop_name}}</div>
                                <span class="excerpt d-block">{{$relatedProduct->product_name}}</span>
                                <span class="price"><span class="number">₱{{number_format($relatedProduct->retail_price, 2)}}</span></span>
                                <div class="ratings d-flex align-items-center mt-0">
 <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star rating-color mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <span class="solds">{{$relatedProduct->sales_count}} solds</span>          
                                </div>
                                <a href="{{route('productDetails', ['id' => $relatedProduct->id])}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>               
</div>


@if(session('success'))
    <script>
        window.onload = function() {
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        };
    </script>
@endif

@if(session('Failed') && session('showModal'))
    <script>
        window.onload = function() {
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        };
    </script>
@endif
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Product added to cart successfully!</p>
            </div>
        </div>
    </div>
</div>



<div class="modal fade md-6" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content p-2">
            <div class="modal-header text-center d-flex justify-content-between" style="color: #092C4C">
                <div class="d-flex">
                    <img src="{{asset('images/warning.svg')}}" class="me-2">
                    <h5 class="modal-title fs-5 fw-semibold ml-3">ADD ITEM?</h5>
                </div>

                <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('productDetails.clearandadd') }}" method="POST" id="ContinueaddToCartForm" >
                    @csrf
                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                    <input type="number" class="quantity d-none" name="quantity" value="1">
                    @if ($variants->isNotEmpty())
                    <input type="number" id="size" name="size" value="{{ $variants->first()->id }}" class="d-none">
                    @endif
                    <button type="button" class="btn btn-primary" id="continueAddToCartButton">Add Anyway</button>
                </form>
             
            </div>
        </div>
    </div>
</div>

<div id="loadingIndicator" class="d-none position-fixed top-0 start-50 translate-middle-x w-100 vh-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50"  >
    <div class="spinner-border text-primary mt-5" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> 
<script>
    // Increment and decrement button functionality
    const selectorQuantity = document.getElementById('selectorQuantity');
    const formQuantities = document.querySelectorAll('.quantity'); // NodeList of all inputs with class "quantity"
    const incrementButton = document.getElementById('increment');
    const decrementButton = document.getElementById('decrement');

    // Update the form quantity inputs whenever the selector changes
    function updateQuantity(value) {
        selectorQuantity.value = value; // Update the selector quantity
        // Loop through all elements with class "quantity" and update their value
        formQuantities.forEach(input => {
            input.value = value;
        });
    }

    // Increment button logic
    incrementButton.addEventListener('click', function () {
        let currentQuantity = parseInt(selectorQuantity.value, 10);
        currentQuantity++;
        updateQuantity(currentQuantity); // Update all quantities
    });

    // Decrement button logic
    decrementButton.addEventListener('click', function () {
        let currentQuantity = parseInt(selectorQuantity.value, 10);
        if (currentQuantity > 1) {
            currentQuantity--;
            updateQuantity(currentQuantity); // Update all quantities
        }
    });


    // AJAX form submission


    $(document).on('submit', '#addToCartForm', function (e) {
    e.preventDefault();

    const form = $(this);
    const formData = form.serialize();
    $('#loadingIndicator').removeClass('d-none');

    $.ajax({
        url: "{{ route('productDetails.addToCart') }}", // Laravel route
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token
        },
        success: function (response) {
            $('#loadingIndicator').addClass('d-none');

            // Only show the success modal if the response indicates success
            if (response.success) {
                console.log(response);

                // Show success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                $('#successModal .modal-body').text(response.message);
                successModal.show();

                updateQuantity(1);
            } else {
                // Handle server-side failure by showing error modal
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            }
        },
        error: function (xhr) {
            if (xhr.status === 401) {
            // Redirect to login if unauthenticated
            window.location.href = "{{ route('login') }}";
            } else {
                // Show error modal for other errors
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                let errorMessage = "An error occurred. Please try again.";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                $('#errorModal .modal-body').text(errorMessage);
                errorModal.show();
            }
        },
    });
});

document.getElementById('continueAddToCartButton').addEventListener('click', function () {
    const form = document.getElementById('ContinueaddToCartForm');
    const formData = new FormData(form); // Gather all form data

    // Log all form data entries for debugging
    $('#errorModal .close').click();
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // CSRF token
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle success response
            $('#loadingIndicator').addClass('d-none');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            $('#successModal .modal-body').text(data.message); // Use 'data' instead of 'response'
            successModal.show();
        })
        .catch(error => {
            // Handle error response
            console.error('Fetch error:', error);
            alert('Failed to add product to cart.');
        });
});

//message snet
document.addEventListener("DOMContentLoaded", function() {
    const chatIcon = document.getElementById('chatIcon');

    chatIcon.addEventListener('click', function() {
        const shopId = this.getAttribute('data-shop-id');
        const message = 'Hello! How can I assist you?';

        fetch("{{ route('start.shop.chat') }}", { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                shop_id: shopId,
                message: message,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('start.chat') }}";
                console.log('Message sent by user:', data.sender_id);
            } else {
                alert(data.message); 
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
    });
});


</script>

@endsection
