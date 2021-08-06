<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Control Pedidos') }}</title>


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="diseno/css/animate.css">

    <link rel="stylesheet" href="diseno/css/owl.carousel.min.css">
    <link rel="stylesheet" href="diseno/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="diseno/css/magnific-popup.css">

    <link rel="stylesheet" href="diseno/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="diseno/css/jquery.timepicker.css">


    <link rel="stylesheet" href="diseno/css/flaticon.css">
    <link rel="stylesheet" href="diseno/css/style.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src={{asset('image/pedido.jpg')}} alt="" style="width: 4rem">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Control Pedidos') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menú
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item  active">
                            <a class="dropdown-item" href="/pendientes">Pendientes</a> <div class="dropdown-menu">

                            </div></li>

                        <li class="nav-item  active">
                            <a class="dropdown-item " href="/historial">Historial </a>

                        </li>
                        <li class="nav-item  active">
                            <a class="dropdown-item " href="/empresa">Empresas </a>

                        </li>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div></ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="diseno/js/jquery.min.js"></script>
    <script src="diseno/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="diseno/js/popper.min.js"></script>
    <script src="diseno/js/bootstrap.min.js"></script>
    <script src="diseno/js/jquery.easing.1.3.js"></script>
    <script src="diseno/js/jquery.waypoints.min.js"></script>
    <script src="diseno/js/jquery.stellar.min.js"></script>
    <script src="diseno/js/owl.carousel.min.js"></script>
    <script src="diseno/js/jquery.magnific-popup.min.js"></script>
    <script src="diseno/js/jquery.animateNumber.min.js"></script>
    <script src="diseno/js/bootstrap-datepicker.js"></script>
    <script src="diseno/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="diseno/js/google-map.js"></script>
    <script src="diseno/js/main.js"></script>
    <script src="{{asset("js/empresa.js")}}"></script>
    <script src="{{asset("js/home.js")}}"></script>

</body>
</html>
