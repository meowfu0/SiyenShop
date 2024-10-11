<nav class="d-flex nav flex-column p-4 border-end min-vh-100" style="width: 250px">
    <a class="nav-link d-flex gap-4 fs-5 fw-medium mb-4 justify-content-center" href="#">
        <img class="logo-img" src="{{asset('images/logo.png')}}" alt="">
    </a>
    <a class="sidenav-link d-flex gap-4 fs-5 fw-medium" href="#">
        <img src="{{asset('images/user.svg')}}" alt="">
        Profile
    </a>
    <a class="sidenav-link d-flex gap-4 fs-5 fw-medium" href="#">
        <img src="{{asset('images/purchases.svg')}}" alt="">
        My Purchases
    </a>
    <a class="sidenav-link d-flex gap-4 fs-5 fw-medium" href="javascript:void(0);" onclick="showChat()">
        <img src="{{asset('images/chat.svg')}}" alt="">
        Chat
    </a>
    <!-- Spacer div that takes up remaining space -->
    <div class="mt-auto">
        <a class="sidenav-link d-flex gap-4 fs-5 fw-medium" href="#">
            <img src="{{asset('images/logout.svg')}}" alt="">
            Logout
        </a>
    </div>
</nav>

<script>
    // Get all the sidenav links
    const sidenavLinks = document.querySelectorAll('.sidenav-link');

    // Loop through the links and add a click event listener to each
    sidenavLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Remove the 'active' class from all links
            sidenavLinks.forEach(link => link.classList.remove('active'));

            // Add the 'active' class to the clicked link
            this.classList.add('active');
        });
    });
</script>
