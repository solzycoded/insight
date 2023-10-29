<nav class="navbar navbar-expand-lg navbar-light text-white" style="background-color: #6200AF">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">INSIGHT</a>
        <button class="navbar-toggler bg-white mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item text-white" style="max-width: 200px">
                    <a class="nav-link btn btn-dark text-white ps-3 pe-3 rounded-pill fw-bold" href="/publish-your-work">Publish your work</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white active" aria-current="page" href="/">Home</a>
                </li> --}}
                <li class="nav-item text-white">
                    <a class="nav-link text-white" href="/my-publications">My Publications</a>
                </li>
    
                @auth
                    <li class="nav-item text-white">
                        <form action="/log-out" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-transparent nav-link text-white" href="/login">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item text-white">
                        <a class="nav-link text-white" href="/login">Login</a>
                    </li>
                @endauth
                {{-- <li class="nav-item text-white">
                    <a class="nav-link text-lightgrey disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>