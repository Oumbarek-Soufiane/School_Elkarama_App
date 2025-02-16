<nav class="navbar navbar-expand-lg bg-transparent-tertiary" style=" margin-top: -3%;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        style="position:absolute; right:0; top:35px; ">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="text-align: center;">

        <a class="nav-link" href="{{ route('home') }}" style="margin-right: auto">
            <img class="logo" width="250px" src="{{ asset('img/logo.png') }}" alt="image" />
        </a>

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Annoncements">Annoncements</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="#about_us">About Us</a>
            </li>
            <li class="nav-item About">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
        </ul>

        <div class="d-flex login" id="login_button" class="log">
            <a href="{{ route('login') }}" class="button1" style="margin-left: auto; margin-right: auto;"
                class="nav-link">Login</a>
            </li>
        </div>

    </div>
</nav>
