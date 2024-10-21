<div class="border-bottom d-flex align-items-center justify-content-end bg-white" style="height: 80px; position: sticky; top: 0;">
    <div class="d-flex gap-2 pe-5">
        <img src="{{asset('images/user.svg')}}" alt="">
        @auth
        <div class="text-primary fw-medium d-none d-md-block">
            <div class="dropdown">
                <button class="text-primary fw-medium border-0 bg-white d-none d-md-block" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->first_name }}
                </button>
                <ul class="dropdown-menu border-0 shadow-sm text-wrap">
                    <li><a href="{{ url('/profile') }}" class="dropdown-items nav-link text-primary fw-medium flex-grow-1 px-3 ">Profile</a></li>
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
        </div>
        @endauth
    </div>
</div>