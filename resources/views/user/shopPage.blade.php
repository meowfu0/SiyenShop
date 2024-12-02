@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="card-header">
            <div class="d-flex align-items-center">
            <!--Organizational Filter-->
                <form id="filterForm" method="GET" action="{{ route('shopPage') }}">
                    <label class="organization fw-medium fs-4">Organization</label>
                    <select name="shop_id" id="organization-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="All" {{ request('shop_id') == 'All' ? 'selected' : '' }}>All</option>
                        @foreach ($shops as $id => $name)
                            <option value="{{ $id }}" {{ request('shop_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>

                    <!--Category Filter-->
                    <label class="category fw-medium fs-4">Category</label>
                    <select name="category_id" id="category-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="All" {{ request('category_id') == 'All' ? 'selected' : '' }}>All</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </form> 
            </div>
    </div>
    
    <!--Product List-->
    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gap-5 p-4">
    @foreach ($products as $product)
    <div class="block-7">
        @if (!empty($product->product_image) && Storage::exists('public/Products/' . $product->product_image))
            <img 
                src="{{ Storage::url('public/Products/' . $product->product_image) }}" 
                class="img-fluid" 
                style="width: 190px !important; height: 200px !important; border-radius: 5px;">
        @else
            <img 
                src="{{ asset('images/sample.jpg') }}" 
                class="img-fluid" 
                style="width: 190px !important; height: 200px !important; border-radius: 5px;">
        @endif
        <div class="text-center p-4">
            <div class="badge">{{$product->organization->shop_name}}</div>
            <span class="excerpt d-block">{{$product->product_name}}</span>
            <span class="price"><span class="number">₱{{ number_format($product->retail_price, 2) }}</span></span>
            <div class="ratings d-flex align-items-center mt-0">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa fa-star{{ $i <= floor($product->reviews->first()->average_rating ?? 0) ? ' rating-color' : '' }}"></i>
                @endfor
                <span class="solds">{{$product->sales_count}} solds</span>          
            </div>
            <hr>
            <a href="{{ route('productDetails', ['id' => $product->id]) }}" class="btn btn-primary d-block px-2 py-3">
                View Details<span style="margin-left: 5px;">&#8599;</span>
            </a>
        </div>
    </div>
    @endforeach
</div>


    <script>

    </script>

@endsection
