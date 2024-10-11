@extends('welcome')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
    </div>

    <!-- Dashboard Content -->

    <div class="d-flex gap-3 px-5 pt-5 pb-3">
        <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">User</h4>
            <h2 class="text-primary fw-bolder">1024</h2>
        </div>
        <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Shops</h4>
            <h2 class="text-primary fw-bolder">6</h2>
        </div>
        <div class="border border-primary rounded-4 p-3 px-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Active Users</h4>
            <h2 class="text-primary fw-bolder">41</h2>
        </div>
    </div>

    <div class="d-flex px-5 py-4 gap-4 flex-grow-1 " style="display: table-row;">
        <div class=" border border-primary rounded-4 p-4 " style="flex: 5;">
             <div class="d-flex justify-content-between">
                <h4 class="text-secondary fw-bold">User</h4>
                <a href="{{ route('admin.users') }}" class="text-secondary fs-3">See all</a>
            </div>
            <div>
                    {{-- Content here --}}
            </div>
         </div>
    
        <div class="d-flex flex-column gap-4" style="flex: 2; ">
            <div class="border border-primary rounded-4 p-4 flex-grow-1">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="text-secondary fw-bold">Top Shops</h4>
                </div>
                <div>
                    <h6 class="text-primary fw-bolder">CSC</h6>
                    <h6 class="text-primary fw-bolder">CirCUITS</h6>
                    <h6 class="text-primary fw-bolder">BIOlOGY</h6>
                    <h6 class="text-primary fw-bolder">CHEM</h6>
                    <h6 class="text-primary fw-bolder">METEOROLOGY</h6>
                </div>
                
            </div>

            <div class="border border-primary rounded-4 p-4 flex-grow-1" >
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="text-secondary fw-bold">Shops</h4>
                    <a href="{{ route('admin.shops') }}" class="text-secondary fs-">See all</a>
                </div>
                <div>
                <h6 class="text-primary fw-bolder">CSC</h6>
                    <h6 class="text-primary fw-bolder">CirCUITS</h6>
                    <h6 class="text-primary fw-bolder">BIOlOGY</h6>
                    <h6 class="text-primary fw-bolder">CHEM</h6>
                    <h6 class="text-primary fw-bolder">METEOROLOGY</h6>
                </div>
                
            </div>
        </div>



</div>
@endsection
