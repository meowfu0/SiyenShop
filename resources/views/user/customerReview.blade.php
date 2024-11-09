@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="review col-md-10">
            <h2 class="fs-9 fw-semibold mt-0" style="color: #092C4C">Customer Reviews</h2>
            <div class="ratings d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center mb-2" style="color: #363636">
                    <span class="product-rating fs-14 fw-medium mb-0">4.6</span><span class="fs-8">/5</span>
                </div>
                <div class="stars d-flex justify-content-center mb-2">
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
            <div class="ml-4 mt-4 d-flex flex-row comment-row p-3" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                <div class="p-2 mt-2">
                    <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                </div>
                <div class="comment-text w-100 ps-2 pt-3">
                    <div class="d-flex  justify-content-between">
                        <p class="m-0">Juan Dela Cruz</p>
                        <p class="m-0">April 14, 2019</p>
                    </div>
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

            <div class="ml-4 mt-4 d-flex flex-row comment-row p-3" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                <div class="p-2 mt-2">
                    <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                </div>
                <div class="comment-text w-100 ps-2 pt-3">
                    <div class="d-flex  justify-content-between">
                        <p class="m-0">Juan Dela Cruz</p>
                        <p class="m-0">April 14, 2019</p>
                    </div>
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

            <div class="ml-4 mt-4 d-flex flex-row comment-row p-3" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                <div class="p-2 mt-2">
                    <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                </div>
                <div class="comment-text w-100 ps-2 pt-3">
                    <div class="d-flex  justify-content-between">
                        <p class="m-0">Juan Dela Cruz</p>
                        <p class="m-0">April 14, 2019</p>
                    </div>
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


            <div class="ml-4 mt-4 d-flex flex-row comment-row p-3" style="border: 1px solid #BDBDBD; border-radius: 8px;">
                <div class="p-2 mt-2">
                    <span class="round"><img src="{{asset('images/user.svg')}}" alt="user" width="25"></span>
                </div>
                <div class="comment-text w-100 ps-2 pt-3">
                    <div class="d-flex  justify-content-between">
                        <p class="m-0">Juan Dela Cruz</p>
                        <p class="m-0">April 14, 2019</p>
                    </div>
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
@endsection
