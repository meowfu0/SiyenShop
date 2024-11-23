@extends('layouts.shop')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/toggleswitch.css') }}">
</head>


    @if(request()->has('product'))
        <livewire:shop-products-edit :productId="request()->query('product')" />
    @else
        <div class="alert alert-warning">
            No product ID provided. Please select a product to edit.
        </div>
    @endif

<div class="flex-grow-1" style="width: 100%!important;">
     <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{ asset('images/user.svg') }}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
     </div>
     
     <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height: 70px">
        <div class="ps-3">
            <img src="{{ asset('images/Circuits.svg') }}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
     </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Edit Product</h2>
    </div>

    <div>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" class="form-control" wire:model="product_name">
            @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea id="product_description" class="form-control" wire:model="product_description"></textarea>
            @error('product_description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>

        @if (session()->has('message'))
            <div class="mt-2 text-success">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>

@endsection