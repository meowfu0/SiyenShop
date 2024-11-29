@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')

    @include('components.chat', ['contacts' => $contacts, 'messages' => $messages])
</div>
@endsection
