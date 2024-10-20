@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')

    <!-- Welcome Message Below Navbar -->
    <div class="mt-3">
        Welcome to {{ Route::current()->uri() }}
    </div>
</div>
@endsection
