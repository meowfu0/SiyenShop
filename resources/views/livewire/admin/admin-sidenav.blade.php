<!-- resources/views/livewire/navigation.blade.php -->
<nav class="d-flex nav flex-column p-4 border-end gap-2" style="width: 240px; position: sticky; top: 0; height: 100vh;">
    <a class="nav-link d-flex gap-4 fs-5 fw-medium mb-5 justify-content-center" href="/home" wire:navigate>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="">
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
        href="{{ route('admin.dashboard') }}" wire:navigate>
        <img src="{{ asset('images/dashboard.svg') }}" alt="">
        Dashboard
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}"
        href="{{ route('admin.users') }}" wire:navigate>
        <img src="{{ asset('images/users.svg') }}" alt="">
        Users
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'admin.shops' ? 'active' : '' }}"
        href="{{ route('admin.shops') }}" wire:navigate>
        <img src="{{ asset('images/shops.svg') }}" alt="">
        Shops
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'admin.faqs' ? 'active' : '' }}"
        href="{{ route('admin.faqs') }}" wire:navigate>
        <img src="{{ asset('images/faqs.svg') }}" alt="">
        FAQs
    </a>

    <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'admin.chat' ? 'active' : '' }}"
        href="{{ route('admin.chat') }}" wire:navigate>
        <img src="{{ asset('images/chat.svg') }}" alt="">
        Chat
    </a>

    <div class="mt-auto">
        <a class="sidenav-link ps-4 d-flex gap-4 fs-4 fw-medium {{ Route::currentRouteName() == 'shop.logout' ? 'active' : '' }}"
            href="" wire:navigate>
            <img src="{{ asset('images/logout.svg') }}" alt="">
            Logout
        </a>
    </div>
</nav>
