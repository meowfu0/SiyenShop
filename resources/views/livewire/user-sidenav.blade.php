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