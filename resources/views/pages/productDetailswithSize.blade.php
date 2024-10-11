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
                <p class="title">CirCUITS T-Shirt</p>
                    <p class="sold">40 sold</p>
                <p class="price">₱250.00</p>
                <div class="size-variation">
                    <p class="size">Size</p>
                    <button>XS</button>
                    <button>S</button>
                    <button>M</button>
                    <button>L</button>
                    <button>XL</button>
                </div>
                <div class="quantity">
                    <p class="quantity-text">Quantity</p>
                    <div class="quantity-selector">
                        <button id="decrement">-</button>
                        <input type="text" id="quantity" value="1" readonly>
                        <button id="increment">+</button>
                    </div>
                </div>
            </div>
            <div class="box three">
                <img src="{{asset('images/vector.png')}}" class="chat-icon">
                <button id="addtocart" class="cart-btn">Add to Cart</button>
                <button id="buynow" class="buy-btn">Buy Now</button>
            </div>
        </div>
    </div>
    <div class="productdetails">
        <h2>Details</h2>
        <h5>Circuit T-Shirt</h5>
        <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis. </p>
        <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. </p>
        <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. </p>
    </div>
    <div class="customerreview">
        <h2>Reviews</h2>
        <div class="review one">
            <img src="{{asset('images/profile-icon.png')}}" class="chat-icon">
            <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. Leo amet in auctor tellus egestasetia m nunc quis. </p>
        </div>
        <div class="review two">
            <img src="{{asset('images/profile-icon.png')}}" class="chat-icon">
            <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. </p>
        </div>
        <div class="review three">
            <img src="{{asset('images/profile-icon.png')}}" class="chat-icon">
            <p>Lorem ipsum dolor sit amet consectetur. Integer ut sed praesent eget auctor donec egestas orci amet. </p>
        </div>
    </div>
</div>

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