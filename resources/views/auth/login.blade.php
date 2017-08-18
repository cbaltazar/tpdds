@extends ('auth.master')
@section ('title','Acceder')
@section ('type','loginscreen')
@section ('content')
    <h3>¿Dónde invierto?</h3>
    <p>Ingresa tu email y contraseña para acceder a la aplicación.</p>
    <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <!--div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <small>Recordarme</small>
                    </label>
                </div>
        </div>
        <br-->
        <button type="submit" class="btn btn-primary block full-width m-b">Acceder</button>
        <a class="text-muted btn btn-sm btn-default btn-rounded btn-outline" href={{ url('register') }}>Crear cuenta</a>


    </form>
@endsection
