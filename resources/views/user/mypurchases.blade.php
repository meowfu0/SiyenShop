@extends('layouts.app')

@section('content')

<div class="d-flex">
    @livewire('user-sidenav')
    <div>
        @include('user.My_Purchase_Page')
    </div>
</div>

@endsection
