@extends('layouts.user')

@section('content')
<div class="fs-12">
    Welcome to {{ Route::current()->uri() }}
</div>

@endsection