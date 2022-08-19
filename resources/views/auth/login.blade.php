@extends('layouts.app')

@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
          <a href="{{ route('login') }}"><b>{{ config('app.name', 'Facturacion APP') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Iniciar Sesión</p>

            <form  method="POST" action="{{ route('login') }}">
              @csrf
              <div class="input-group mb-3">
                <input type="text" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>

                @error('email')
                    <span id="emailFeedback" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password')
                    <span id="passwordFeedback" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                      Recuerdame
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
                </div>

                <div class="col-12">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('¿Olvidastes la contraseña?') }}
                        </a>
                    @endif
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.login-card-body -->
        </div>
    </div>
</div>

@endsection
