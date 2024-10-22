@extends('layouts.app')

@section('content')

<div class="d-flex">
    @livewire('user-sidenav')
    <div>
        @include('Order_Management_Module.My_Purchase_Page')
    </div>
</div>

@endsection
