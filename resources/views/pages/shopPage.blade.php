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
    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gap-3 p-4">  
        <div class="block-7">
                                <div class="img" style="background-image: url(https://www.bootdey.com/image/350x280/87CEFA/000000);"></div>
                                <div class="text-center p-4">
                                    <span class="excerpt d-block">CirCUITS Lanyard</span>
                                    <span class="price"><span class="number">₱250.00</span></span>
                                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3" >View Details</a>
                                </div>
                            </div>
                            <div class="block-7">
                                <div class="img" style="background-image: url(https://www.bootdey.com/image/350x280/87CEFA/000000);"></div>
                                <div class="text-center p-4">
                                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                    <span class="price"><span class="number">₱250.00</span></span>
                                    <a href="{{url('productDetailswithSize')}}" class="btn btn-primary d-block px-2 py-3">Get Started</a>
                                </div>
                            </div>
                            <div class="block-7">
                                <div class="img" style="background-image: url(https://www.bootdey.com/image/350x280/87CEFA/000000);"></div>
                                <div class="text-center p-4">
                                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                    <span class="price"><span class="number">₱250.00</span></span>
                                    <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
                                </div>
                            </div>
                            <div class="block-7">
                                <div class="img" style="background-image: url(https://www.bootdey.com/image/350x280/87CEFA/000000);"></div>
                                <div class="text-center p-4">
                                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                    <span class="price"><span class="number">₱250.00</span></span>
                                    <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
                                </div>
                            </div>
                            <div class="block-7">
                                <div class="img" style="background-image: url(https://www.bootdey.com/image/350x280/87CEFA/000000);"></div>
                                <div class="text-center p-4">
                                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                                    <span class="price"><span class="number">₱250.00</span></span>
                                    <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
                                </div>
    </div>
</div>
                            
                            </div>
                        </div>
                    </div> 
                </div>
        </div>
    </div>
</div>
@endsection