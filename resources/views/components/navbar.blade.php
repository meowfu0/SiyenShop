@if(!View::hasSection('no_navbar'))
<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom d-flex justify-content-center sticky-top">
    <div class="container-xxl m-0 mx-md-5">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{ asset('images/hamburger.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
            </button>

            <a class="logo d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" class="logo-img">
            </a>
        </div>

        <!-- Middle Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="d-flex navbar-nav al justify-content-center flex-grow-1">
                <li class="nav-item ">
                    <a class="nav-link text-primary fw-medium {{ Route::currentRouteName() == 'home' ? 'active fw-bolder' : '' }}" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-medium" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-medium" href="{{ url('/faq') }}">FAQs</a>
                </li>
            </ul>
        </div>
        
        <!-- Right Side Of Navbar -->
        <div class="d-flex ms-auto gap-2 align-items-center">
            <!-- Search Icon -->
            <a class="icons" href="{{ url('/') }}">
                <img src="{{ asset('images/search.svg') }}" class="search-img">
            </a>

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

                        <a class="icons me-2 d-none d-md-block" href="{{ url('/profile') }}">
                            <img src="{{ asset('images/user.svg') }}" class="user-img">
                        </a>
                        <div class="dropdown d-md-none dropstart">
                            <button class="icons border-0 bg-white p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/user.svg') }}" class="user-img">
                            </button>
                            <ul class="dropdown-menu mt-4">
                                <li><a href="{{ url('/profile') }}" class="dropdown-items nav-link flex-grow-1 px-3 ">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="" class="dropdown-items nav-link flex-grow-1 px-3 ">My Purchases</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="" class="dropdown-items nav-link flex-grow-1 px-3 ">Chat</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="#" class="dropdown-items nav-link flex-grow-1 px-3 " 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>


                        <div class="dropdown">
                            <button class="text-primary fw-medium border-0 bg-white d-none d-md-block" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->first_name }}
                            </button>
                            <ul class="dropdown-menu border-0 shadow-sm text-wrap">
                                <li><a href="{{ url('/profile') }}" class="dropdown-items nav-link text-primary fw-medium flex-grow-1 px-3 ">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="" class="dropdown-items nav-link text-primary fw-medium flex-grow-1 px-3 ">My Purchases</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="" class="dropdown-items nav-link text-primary fw-medium flex-grow-1 px-3 ">Chat</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="#" class="dropdown-items nav-link text-primary fw-medium flex-grow-1 px-3 " 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            
                          </div>
                        {{-- <div class="text-primary fw-normal d-none d-md-block">
                            
                            <select name="" id="">
                                <option value="profile">
                                    <a href="">Profile</a>
                                </option>

                                <option value="purchaes">
                                    <a href="">My purchases</a>
                                </option>

                                <option value="chat">
                                    <a href="">Chat</a>
                                </option>

                                <option value="logout">
                                    <a href="">Logout</a>
                                </option>
                            </select> --}}
                        </div>

                        
                        
                    </div>
                    
            @endauth
        </div>
    </div>
</nav>
@endif
