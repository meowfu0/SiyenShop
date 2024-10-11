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

    <!-- Welcome Message Below Navbar -->
    <div class="mt-3">
        Welcome to {{ Route::current()->uri() }}
    </div>
</div>
@endsection
