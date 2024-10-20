<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom d-flex justify-content-center sticky-top" >
    <div class="container-xxl m-0 mx-md-5">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('images/hamburger.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
        </button>
        </div>

<!-- Right Side Of Navbar -->
        <div class="d-flex ms-auto gap-2 align-items-center">

            <!-- Login Button -->
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item me-3">
                            <a class="text-white bg-secondary btn fw-medium ms-2 px-4 py-0 py-md-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
             <!-- This section will appear once logged in -->
                @auth
                <div class="d-flex ab align-items-center gap-3">
                    <a class="icons" href="{{ url('/') }}">
                        <img src="{{ asset('images/cart.svg') }}" class="cart-img">
                    </a>

                    <div class="d-flex align-items-center">
                        <a class="icons me-2" href="{{ url('/user') }}">
                            <img src="{{ asset('images/user.svg') }}" class="user-img">
                        </a>
                        <div class="text-primary fw-normal d-none d-md-block">
                            {{ Auth::user()->first_name }}
                        </div>
                        
                        
                    </div>
                    
            @endauth
        </div>

    </div>
</nav>
