<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="icon" type="image/png" href="/image/pedido.jpg" />
</head>

<body style="background-image: url('diseno/images/a3.jpg')">

<div class="container" id="log-in-form">

    <div class="heading">
        <div class="container">
            <div class="container">
                <div class="card">
                    <div style="font-weight: bold" class="card-title" align="center" ><h1 style="color: #f6f1ed">Iniciar Sesión</h1></div>
                    <br>
                    <br>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row" style="color: #f6f1ed">
                                <label for="email" class="container col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-4" style="color: #f6f1ed">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="color: #f6f1ed">
                                <label for="password" class="container col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="color: #f6f1ed">
                                <div class="container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recuérdame') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0" style="color: #f6f1ed">
                                <div class="col-md-16 offset-md-8">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Entrar') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-success" style="color: #eae5e5" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
</body>

</html>
