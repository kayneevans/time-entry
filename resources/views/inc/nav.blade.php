
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container d-flex flex-row justify-content-between">
        <a class="navbar-brand" href="/dashboard">Time Entry</a>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                @auth
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>
            @else
            <a class="nav-item nav-link" href="{{route('login')}}">Login</a>

            @endauth
        </ul>
    </div>
</nav>

