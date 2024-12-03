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
                    @if (!empty($product->product_image) && Storage::exists('public/Products/' . $product->product_image))
                        <img 
                            src="{{ asset('storage/Products/' . $product->product_image) }}" 
                            class="img-fluid" 
                            style="width: 400px !important; height: 100% !important; border-radius:5px;">
                    @else
                        <img 
                            src="{{ asset('images/sample.jpg') }}" 
                            class="img-fluid" 
                            style="width: 400px !important; height: 100% !important; border-radius:5px;">
                    @endif
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
                        
                        @if($product->status->status_name === 'onhand')
                                    <p class="fs-4 pt-1">Stocks left: <b>{{ $product->stocks }}</b></p>
                                @endif


                        <div class="size-variation">
                            <p class="size mb-1 mt-2" style="color: #092C4C">Size</p>
                        
                            @foreach ($variants as $index => $variant)
                                <!-- Radio button to select a size -->
                                <input type="radio" class="btn-check ms-1" name="btnradio" id="btnradio{{$index}}" autocomplete="off"
                                       {{ $loop->first ? 'checked' : '' }} value="{{$variant->id}}" 
                                       onclick="document.getElementById('size').value = {{$variant->id}}">
                                <label class="btn btn-outline-primary" for="btnradio{{$index}}">{{$variant->size}}</label>
                            @endforeach
                        </div>
                        
                            @endif
                            <div class="quantity mb-4">
                                
                            
                                <p class="quantity-text mb-1 mt-0" style="color: #092C4C">Quantity</p>
                                <div class="quantity-selector" style="height:35px; width:80px">
                                    <button type="button" id="decrement" style="color: #092C4C">-</button>
                                    <input type="text" id="selectorQuantity" value="1" readonly style="color: #092C4C">
                                    <button type="button" id="increment" style="color: #092C4C">+</button>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center w-100" style="margin-top: 5rem;">
                                <img src="{{ asset('images/chat.svg') }}" class="chat-icon" style="width:22px; height:22px">
                                <!-- Add to Cart Button -->
                                <form action="{{ route('productDetails.addToCart') }}" method="POST" id="addToCartForm" style="cursor: pointer;">
                                    @csrf
                                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                                    <input type="number" class="quantity d-none" name="quantity" value="1">
                                    @if ($variants->isNotEmpty())
                                        <input type="number" id="size" name="size" value="{{ $variants->first()->id }}" class="d-none">
                                    @endif

                                    <button type="submit" 
                                        class="btn btn-primary fw-medium d-flex align-items-center justify-content-center gap-2"
                                        style="width:130px; height:48px"
                                        {{ $product->stocks <= 0 && $product->status_id === 8 ? 'disabled' : '' }}>
                                        <img src="{{ asset('images/cart.svg') }}" class="invert" style="width:15px; height:15px"> 
                                        Add to Cart
                                    </button>
                                </form>

                                <!-- Buy Now Button -->
                                <form action="{{ route('productDetails.buy') }}" method="POST" id="buyNow" style="cursor: pointer;">
                                    @csrf
                                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                                    <input type="number" class="quantity d-none" name="quantity" value="1">
                                    @if ($variants->isNotEmpty())
                                        <input type="number" id="size" name="size" value="{{ $variants->first()->id }}" class="d-none">
                                    @endif

                                    

                                    
                                    <button type="submit" id="buyNowButton" class="btn btn-secondary fw-medium d-flex align-items-center justify-content-center gap-2"
                                        style="width:130px; height:48px; color:white"
                                        {{ $product->stocks <= 0 && $product->status_id === 8 ? 'disabled' : '' }}>
                                        <img src="{{ asset('images/cart.svg') }}" class="invert" style="width: 15px; height:15px"> Buy Now
                                    </button>
                                </form>
                                
                                
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
                            <div class="ml-4 mt-4 d-flex flex-row comment-row" style="border: 1px solid #BDBDBD; border-radius: 8px; padding: 10px;">
                                <div class="p-2" style="margin-top: -2px;"> 
                                <span class="round">
                                    <img src="{{ asset('images/user.svg') }}" alt="user" width="25" style="margin-top: -3px;"> </span>
                            </div>

                                    <div class="comment-text w-100">
                                <!-- Name and Date -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fs-5 mb-1">{{ $review->user->first_name }} {{ $review->user->last_name }}</p>
                                    <p class="fs-3 text-muted mb-1" style="margin-right: 5px;">{{ $review->review_date }}</p>
                                </div>

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
                <div class="row col-md-12 justify-content-center ">
    <h2 class="fs-9 fw-semibold mt-3" style="color: #092C4C">You may also like</h2>
    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gap-5 justify-content-center">
        @foreach ($relatedProducts as $relatedProduct)
        <div class="block-7 pd">
            @if (!empty($relatedProduct->product_image) && Storage::exists('public/Products/' . $relatedProduct->product_image))
                <img 
                    src="{{ asset('storage/Products/' . $relatedProduct->product_image) }}" 
                    class="img-fluid" 
                    style="width: 190px !important; height: 200px !important; border-radius:5px;">
            @else
                <img 
                    src="{{ asset('images/sample.jpg') }}" 
                    class="img-fluid" 
                    style="width: 190px !important; height: 200px !important; border-radius:5px;">
            @endif
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
                <a href="{{route('productDetails', ['id' => $relatedProduct->id])}}" class="btn btn-primary d-block px-2 py-3">
                    View Details<span style="margin-left: 5px;">&#8599;</span>
                </a>
            </div>
        </div>
        @endforeach
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
<div class="modal fade success-modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="width: 100px; height: 200px;">
        <div class="modal-content" style="height: 200px">
            <div class="modal-header d-flex flex-column align-items-center">
                <img src="{{ asset('images/check-modal.svg') }}" class="mb-0" style="width: 100px; height: 100px;">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close" 
                    style="position: absolute; top: 7px; right: 15px; font-size: 25px;">
                    <span aria-hidden="true" style="font-size: 25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Product added to cart successfully!</p>
            </div>
        </div>
    </div>
</div>

@include('components.footer')


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
                <form action="{{ route('productDetails.clearandadd') }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="number" name="product_id" value="{{ $product->id }}" class="d-none">
                    <input type="number" id="quantity" name="quantity" value="1" class="d-none">
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
    const formQuantity = document.getElementById('quantity');
    const incrementButton = document.getElementById('increment');
    const decrementButton = document.getElementById('decrement');

    // Update the form quantity input whenever the selector changes
    function updateQuantity(value) {
        selectorQuantity.value = value;
        formQuantity.value = value;
    }

    // Increment button logic
    incrementButton.addEventListener('click', function () {
        let currentQuantity = parseInt(selectorQuantity.value, 10);
        currentQuantity++;
        updateQuantity(currentQuantity);
    });

    // Decrement button logic
    decrementButton.addEventListener('click', function () {
        let currentQuantity = parseInt(selectorQuantity.value, 10);
        if (currentQuantity > 1) {
            currentQuantity--;
            updateQuantity(currentQuantity);
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


$(document).ready(function() {
    // Trigger the AJAX request when the button is clicked
    $('#continueAddToCartButton').click(function(event) {
        event.preventDefault();  // Prevent the form from submitting normally

        var product_id = $('#product_id').val();  // Product ID from hidden field
        var quantity = $('#quantity').val();  // Quantity from input field

        $('#loadingIndicator').removeClass('d-none');

        $('#errorModal .close').click();


        $.ajax({
            url: '{{ route("productDetails.clearandadd") }}',  // Controller route
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                $('#loadingIndicator').addClass('d-none');

                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                updateQuantity(1);
            },
            error: function(xhr, status, error) {
                // Handle any errors
                alert('Error adding product to cart.');
            }
        });
    });
});

</script>

@endsection