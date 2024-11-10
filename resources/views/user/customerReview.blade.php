@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="review col-md-10"> 
            <h2 class="fs-9 fw-semibold mt-0" style="color: #092C4C">Customer Reviews</h2> 
            <div class="ratings d-flex flex-column align-items-center justify-content-center"> 
                <div class="d-flex align-items-center justify-content-center mb-2" style="color: #363636">
                    <span class="product-rating fs-14 fw-medium mb-0">{{ $roundedAverageRating }}</span><span class="fs-8">/5</span>
                </div>
                <div class="ratings d-flex justify-content-center mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star{{ $i <= floor($averageRating) ? ' rating-color' : '' }}"></i>
                    @endfor
                    
                    </div>
            </div>

            <!--Review Section -->
            @foreach ($reviews as $review)
                <div class="ml-4 mt-4 d-flex flex-row comment-row p-3" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                    <div class="p-2 mt-2">
                        <span class="round"><img src="{{ asset('images/user.svg') }}" alt="user" width="25"></span>
                    </div>
                    <div class="comment-text w-100 ps-2 pt-3">
                        <div class="d-flex justify-content-between">
                            <p class="m-0">{{ $review->user->first_name }} {{ $review->user->last_name }}</p>
                            <p class="m-0">{{ $review->review_date }}</p>
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
@endsection 
