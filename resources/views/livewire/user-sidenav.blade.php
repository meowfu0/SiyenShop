<nav class="d-flex nav flex-column p-4 border-end gap-2" style="width: 260px; position: sticky; top: 0; height: 100vh;">
    <a class="nav-link d-flex gap-4 fs-5 fw-medium mb-5 justify-content-center" href="/home" wire:navigate>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="">
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'user.profile' ? 'active' : '' }}" 
       href="{{ route('user.profile') }}" wire:navigate>
        <img src="{{ asset('images/profile.svg') }}" alt="">
        Profile
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'user.my-purchases' ? 'active' : '' }}" 
       href="{{ route('user.my-purchases') }}" wire:navigate>
        <img src="{{ asset('images/cart.svg') }}" alt="">
        My Purchases
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'user.chat' ? 'active' : '' }}" 
        onclick="showChat()" href="{{ route('user.chat') }}" wire:navigate>
        <img src="{{ asset('images/chat.svg') }}" alt="">
        Chat
    </a>

    <div class="mt-auto">
        <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'user.logout' ? 'active' : '' }}" 
           href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('images/logout.svg') }}" alt="">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

<div class="mt-4">
                <div class="accordion border" id="accordionExample">
                    <div class="d-flex align-items-center border: none;">
                        <!-- Icons Section -->
                        <div class="icon-container d-flex align-items-center me-3">
                            <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                <h1 class="fs-5 fw-bold text-align-center" style="margin: 0">Q1</h1>
                            </div>               
                        </div>


                        <!-- Accordion Section -->
                        <div class="accordion-item w-100 border">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>How can I get a refund?</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>