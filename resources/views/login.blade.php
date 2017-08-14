<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Dónde invierto? | Ingresar</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">DI?</h1>
            </div>
            <h3>Ingresa en ¿Dónde Invierto?</h3></br>
            <p>Ingresa tus datos para comenzar a operar.</p>
            <form class="m-t" role="form" action={{ url('companyList') }}>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>
                </br>
                <p class="text-muted text-center"><small>¿Todavía no tienes cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href={{ url('register') }}>Registrate</a>
            </form>
            <p class="m-t"> <small> Desarrollado para la cátedra de Diseño de Sistemas </br> <strong>UTN-FRBA</strong></small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
