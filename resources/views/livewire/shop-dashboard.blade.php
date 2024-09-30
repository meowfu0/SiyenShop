@extends('welcome')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
     <div class="border-bottom d-flex align-items-center justify-content-end " style="height: 80px; ">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
               
            </div>
            @endauth
        </div>
     </div>
     <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{asset('images/Circuits.svg')}}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students </h2>
     </div>
 
    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Sales Analytics</h2>
        <div class="d-flex align-items-center gap-2">
            <p class="fs-3 fw-medium m-0 text-primary">Filter Date</p>
            <input type="date" class="border border-primary rounded-2 p-2 text-primary">
        </div>
    </div>
    
    <div class="d-flex gap-4 px-5">
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Gross Sales</h4>
            <h3 class="text-primary fw-bold">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Net Income</h4>
            <h3 class="text-primary fw-bold">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Orders</h4>
            <h3 class="text-primary fw-bold">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Total Orders</h4>
            <h3 class="text-primary fw-bold">P 99,999.00</h3>
        </div>
    </div>
  
  
    <div class="d-flex px-5 py-4 gap-4 flex-grow-1 " style="display: table-row;">
        <div class=" border border-primary rounded-4 p-4 " style="flex:4;">
             <div class="d-flex justify-content-between">
                <h4 class="text-secondary fw-bold">Recent  Orders</h4>
                <a href="{{ route('shop.orders') }}" class="text-secondary">See all</a>
            </div>
            <div>
                    {{-- Content here --}}
            </div>
         </div>
    
            <div class="d-flex flex-column gap-4 " style="flex:2; ">
                <div class="border border-primary rounded-4 p-4 flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-secondary fw-bold">Unverified Payments</h4>
                        <a href="{{ route('shop.orders') }}" class="text-secondary">See all</a>
                    </div>
                    <div>
                        {{-- Content here --}}
                    </div>
                    
                </div>
    
                <div class="border border-primary rounded-4 p-4 flex-grow-1" >
                    <div class="d-flex justify-content-between">
                        <h4 class="text-secondary fw-bold">Stock Alert</h4>
                        <a href="{{ route('shop.products') }}" class="text-secondary">See all</a>
                    </div>
                    <div>
                        {{-- Content here --}}
                    </div>
                    
                </div>
            </div>
        </div>

</div>
@endsection
