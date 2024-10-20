<header>
    <nav class="navbar navbar-expand-lg bg-light d-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Build pc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('builds.display')}}">View Build</a>
                    </li>

                    <!-- Show user profile dropdown only if the user is logged in -->
                    @if(auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.userprofile') }}">Profile Settings</a></li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Redirect to login if not logged in -->
                        <script>window.location.href = "{{ route('login') }}";</script>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Navbar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navbar</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#collapseProfileOffcanvas" aria-expanded="false" aria-controls="collapseProfileOffcanvas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        {{ auth()->user()->name }}
                    </a>
                    <div class="collapse" id="collapseProfileOffcanvas">
                        <ul class="list-unstyled ps-3">
                            <li><a class="dropdown-item" href="{{ route('user.userprofile') }}">Profile Settings</a></li>
                        </ul>
                    </div>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Build pc</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Build</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>

<style>
    .dropdown-toggle::after {
        display: none; /* Hides the dropdown arrow */
    }
</style>
