@extends('auth.master')
@section ('title','Registro')
@section ('type','registerscreen')
@section('content')
<h3>¿Dónde invierto?</h3>
<p>Ingresa tus datos para registrarte en nuestro sistema.</p>
<form class="m-t" role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <input id="name" type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <select id="role" name="role" style="width: 200px;">
            <option value="admin">Administrador</option>
            <option value="std">Estandar</option>
        </select>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary block full-width m-b">Registrar</button>
    </div>
    <a class="text-muted btn btn-sm btn-default btn-rounded btn-outline" href={{ url('login') }} >Ya tengo cuenta</a>
</form>

@endsection
