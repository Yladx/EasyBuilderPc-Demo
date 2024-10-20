<!-- Navbar with Login/SignUp Button -->
<header>
    <nav class="navbar navbar-expand-lg bg-light d-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('guest') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('builds.display')}}">View Build</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success ms-md-2 ms-xs-1" data-bs-toggle="modal" data-bs-target="#signModal" href="#">Login/SignUp</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

