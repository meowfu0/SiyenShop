@extends('layouts.app')

@section('content')

<div class="d-flex ">
    <div class="d-none d-md-flex flex-md-row">
        @livewire('user-sidenav')
    </div>
    <div class="w-100">

    @include('components.chat', ['contacts' => $contacts, 'messages' => $messages])

    </div>
</div>

@endsection
