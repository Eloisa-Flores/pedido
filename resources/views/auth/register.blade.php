<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body style="background-image: url('diseno/images/a3.jpg')" >
<div class="container" id="registration-form" align="center" style="background-color:transparent">
    <div class="image"></div>
    <div class="frm justify-content">
    <div class="container" align="center">
        <div class="row justify-content-center" >
            <br>
            <div class="container" style="color: #f6f1ed" align="center">
                <div class="card"  >
                    <div class="card-title" style="font-weight: bold"  align="center">{{ __('Registro') }}</div>

                    <div class="card-body">
                        <form method="POST"  action="{{ route('register') }}">
                            @csrf
<br>
                            <br>
                            <div class="form-group row" style="color: #f6f1ed" >
                                <label for="name" style="background-color: #91694a" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
<br>
                            <div class="form-group row" style="color: #f6f1ed">
                                <label for="email" style="background-color: #91694a" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
<br>
                            <div class="form-group row" style="color: #f6f1ed">
                                <label for="password" style="background-color: #91694a" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
<br>
                            <div class="form-group row" style="color: #f6f1ed">
                                <label style="background-color: #91694a" for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-6" style="color: #f6f1ed">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
<br><br>
            <div class="container" align="center" style="color: #f6f1ed">
                <div class="container" align="center" style="color: #f6f1ed">
                    <button type="submit" class="btn btn-success" >
                        {{ __('Registrarse') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>


