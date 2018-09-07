<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Register/Login </title>
        <link rel="shortcut icon" type="image/x-icon" href="https://laravel.com/favicon.png" />
        <!-- CSS And JavaScript -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('static/fontawesome/css/all.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type=text/javascript>
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{url('/home')}}">
                <i class="fas fa-home"></i> Home
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (Auth::check())
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/form/add-task')}}"> Page Task</a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/register')}}">Register</a>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>
        <div class="container container-fluid">
            @yield('content')
        </div>

        <script src="{{ asset('static/jquery/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('static/bootstrap/js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>