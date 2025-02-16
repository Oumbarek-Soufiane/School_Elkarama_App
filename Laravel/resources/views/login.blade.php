@extends('layout.footer')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .message-error {
            color: rgb(248, 99, 99);
            margin-top: -10px;
            margin: 2;
        }
    </style>
    <title>AIM</title>
</head>

<body>

    <div class=" login_container d-flex flex-column mt-3 align-items-center  justify-content-center border h-auto  ">
        <a class="nav-link" href="{{ route('home') }}">
            <img width="300px" src="{{ asset('img/logo.png') }}" alt="image" />
        </a>
        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input style="width:300px" type="text" name="email" placeholder="Email" class="form-control "
                    required /><br>
                <input type="password" name="password" placeholder="Password" class="form-control" required /><br>
                @if (session('error'))
                    <p class="text-left message-error">{{ session('error') }}</p>
                @endif
                <input class="btn btn-primary w-100 login_button border-none fw-bold " type="submit" name="submit"
                    value="Login" /><br>
            </form>
        </div>
        <div class=" d-flex login_info justify-content-between">
            <p class="mx-3 mt-3 fw-semibold text-white">Dont have an account ? <a
                class="mt-3 text-decoration-none sign_up" href="{{ route('register') }}">Sign Up</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
