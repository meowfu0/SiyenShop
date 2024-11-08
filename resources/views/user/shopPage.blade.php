@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <!--Organizational Filter-->
            <form id="filterForm" method="GET" action="{{ route('shopPage')}}">
            <label class="organization fw-medium fs-4">Organization</label>
                <select name="shop_id" id="organization-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="All"{{ request('All') == 'All' ? 'selected' : ''}}>All</option>
                    <option value="1"{{ request('shop_id') == '1' ? 'selected' : ''}}>CSC</option>
                    <option value="2"{{ request('shop_id') == '2' ? 'selected' : ''}}>CIRCUITS</option>
                    <option value="6"{{ request('shop_id') == '6' ? 'selected' : ''}}>ACCESS</option>
                    <option value="5"{{ request('shop_id') == '5' ? 'selected' : ''}}>STORM</option>
                    <option value="3"{{ request('shop_id') == '3' ? 'selected' : ''}}>SYMBIOSIS</option>
                    <option value="4"{{ request('shop_id') == '4' ? 'selected' : ''}}>CHESS</option>
                </select>

            <!--Category Filter-->
            
            <label class="category fw-medium fs-4">Category</label>
                <select name="category_id" id="category-select" onchange="document.getElementById('filterForm').submit()">
                <option value="All"{{ request('All') == 'All' ? 'selected' : ''}}>All</option>
                    <option value="1" {{ request('category_id') == '1' ? 'selected' : ''}}>T-Shirt</option>
                    <option value="2" {{ request('category_id') == '2' ? 'selected' : ''}}>Lanyard</option>
                    <option value="3" {{ request('category_id') == '3' ? 'selected' : ''}}>Tote-Bag</option>
                    <option value="4" {{ request('category_id') == '4' ? 'selected' : ''}}>Stickers</option>
                    <option value="5" {{ request('category_id') == '5' ? 'selected' : ''}}>Pins</option>
                    <option value="6" {{ request('category_id') == '6' ? 'selected' : ''}}>Keyholder</option>
                </select>
            </form>
        </div>
    </div>
    
    <!--Product List-->
    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gap-5 p-4">
        @foreach ($products as $product)
        
        
        <div class="block-7">
            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
            <div class="text-center p-4">
                <div class="badge">{{$product->organization->shop_name}}</div>
                <span class="excerpt d-block">{{$product->product_name}}</span>
                <span class="price"><span class="number">₱{{$product->retail_price}}</span></span>
                <div class="ratings d-flex align-items-center mt-0">
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star rating-color mr-1"></i>
                                <i class="fa fa-star mr-1"></i>
                                <span class="solds">{{$product->sales_count}} solds</span>          
                </div>
                <hr>
                <a href="{{ $product->category->category_name === 'T-Shirt' 
            ? route('productDetailswithSize', ['id' => $product->id]) 
            : route('productDetails', ['id' => $product->id]) }}" 
   class="btn btn-primary d-block px-2 py-3">
    View Details<span style="margin-left: 5px;">&#8599;</span>
</a>
            </div>
        </div>

        @endforeach
    </div>
</div>

    <script>

    </script>

@endsection
