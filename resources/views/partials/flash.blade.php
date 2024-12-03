@if(session('alert'))
    <div class="alert alert-warning text-center">
        {{ session('alert') }}
    </div>
@endif