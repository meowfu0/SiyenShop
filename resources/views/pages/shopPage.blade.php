@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <p class="organization fw-medium fs-4">Organization</p>
            <form id="L" method="post">
                <select name="Organization">
                    <option value="#">All</option>
                    <option value="#">CSC</option>
                    <option value="#">CIRCUITS</option>
                    <option value="#">ACCESS</option>
                    <option value="#">STORM</option>
                    <option value="#">SYMBIOSIS</option>
                    <option value="#">CHESS</option>
                </select>
            </form>
            <p class="category fw-medium fs-4">Category</p>
            <form id="L" method="post">
                <select name="Category">
                    <option value="#">All</option>
                    <option value="#">T-Shirt</option>
                    <option value="#">Lanyard</option>
                    <option value="#">Tote-Bag</option>
                    <option value="#">Stickers</option>
                    <option value="#">Pins</option>
                    <option value="#">Keyholder</option>
                </select>
            </form>
        </div>
    </div>
    
    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gap-5 p-4">
        <div class="block-7">
        <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
            <div class="text-center p-4">
                <div class="badge">CIRCUITS</div>
                <span class="excerpt d-block">CirCUITS Lanyard</span>
                <span class="price"><span class="number">₱250.00</span></span>
                <div class="ratings d-flex align-items-center mt-0">
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star mr-1"></i>
                                <span class="solds">40 solds</span>          
                </div>
                <hr>
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
                                <span class="solds">10 solds</span>          
                </div>
                <hr class="hr">
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
                                <span class="solds">60 solds</span>          
                </div>
                <hr class="hr">
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
                                <span class="solds">45 solds</span>          
                </div>
                <hr class="hr">
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
                                <span class="solds">33 solds</span>          
                </div>
                <hr class="hr">
                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
            </div>
        </div>
    </div>

    <!--new row-->

    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gap-5 p-4">
        <div class="block-7">
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
                <hr class="hr">
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
                <hr class="hr">
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
                <hr class="hr">
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
                <hr class="hr">
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
                <hr class="hr">
                <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>

            </div>
        </div>
    </div>
</div>

@endsection
