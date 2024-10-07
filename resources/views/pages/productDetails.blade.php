@extends('layouts.app')

@section('content')

<div class="container">
    <div class="productcard">
        <div class="grid-child left">
            <img src="{{ asset('images/sample.jpg') }}" class="sample-img">
        </div>
        <div class="grid-child right">
            <div class="box one">
                <p class="status">CIRCUITS</p>
                <p class="status">T-Shirt</p>
                <p class="status">Pre-Order</p>
            </div>
            <div class="box two">
                <p class="title">CirCUITS Lanyard</p>
                <div class="rating-sold-container d-flex justify-content-between align-items-center">
                    <div class="rating d-flex flex-row-reverse">
                        <input type="radio" id="star5" class="d-none" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" class="d-none" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" class="d-none" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" class="d-none" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" class="d-none" name="rating" value="1">
                        <label for="star1"></label>
                    </div>
                    <p class="sold">40 sold</p>
                </div>
                <p class="price">₱250.00</p>
                <div class="quantity-btn">
                    <button class="minus-btn">-</button>
                    <span class="quantity">0</span>
                    <button class="plus-btn">+</button>
                </div>
            </div>
            <div class="box three">
                <p>one</p>
            </div>
        </div>
    </div>
</div>

@endsection