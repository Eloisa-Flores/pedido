<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pedido</title>
        <link rel="icon" type="image/png" href="/image/pedido.jpg" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #6ad0d0;
                color: #620317;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color:#620317;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links" style="font-weight: bold">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="font-weight: bold">Iniciar Sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="font-weight: bold">Registro</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" style="font-weight: bold">

                <div class="title m-b-md">
                    Control de Pedidos
                    <br>
                    Oscar Moncada
                </div>
                <img align="center" src="/image/pedido.jpg">


            </div>
        </div>
    </body>
</html>
