<nav class="d-flex nav flex-column p-4 border-end gap-2" style="width: 260px; position: sticky; top: 0; height: 100vh;">
    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" 
       href="{{ route('shop.dashboard') }}" wire:navigate>
        <img src="{{ asset('images/user.svg') }}" alt="">
        Profile
    </a>
    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'shop.dashboard' ? 'active' : '' }}" 
    href="{{ route('shop.dashboard') }}" wire:navigate>
     <img src="{{ asset('images/bag.svg') }}" alt="">
     My Purchases
    </a>
    <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'shop.chat' ? 'active' : '' }}" 
       href="{{ route('shop.chat') }}" wire:navigate>
        <img src="{{ asset('images/chat.svg') }}" alt="">
        Chat
    </a>

    <div class="mt-auto">
        <a class="sidenav-link ps-4 d-flex gap-4 fs-5 fw-medium {{ Route::currentRouteName() == 'shop.logout' ? 'active' : '' }}" 
           href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('images/logout.svg') }}" alt="">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>
