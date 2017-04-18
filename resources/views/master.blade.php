<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Dónde Invierto? | @yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    @yield('head')
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">¿Dónde invierto?</strong>
                            </span> <span class="text-muted text-xs block">Analista de inversiones <b class="caret"></b></span> </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">DI?</div>
                </li>
                <li> <!--class="active"-->
                    <a href="index.html"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Cuentas</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="{{ url('loadAccounts') }}">Cargar cuentas</a></li>
                        <li><a href="{{ url('viewAccounts') }}">Ver cuentas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-calculator"></i> <span class="nav-label">Indicadores</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('indicatorList') }}">Ver indicadores</a></li>
                        <li><a href="{{ url('indicatorDetail') }}">Editar indicador</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Metodologías</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('methodList') }}">Ver metodologías</a></li>
                        <li><a href="{{ url('methodDetail') }}">Editar metodología</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Bienvenido a ¿Dónde Invierto?</span>
                    </li>
                    <li>
                        <a href="{{ url('lockscreen') }}">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>@yield('title')</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href=#>Home</a>
                    </li>
                    <li class="active">
                        <strong>@yield('title')</strong>
                    </li>
                </ol>
            </div>
        </div>

            @yield('content')

        <div class="footer">
            <div class="pull-right">
                Desarrollado para la cátedra de <strong>Diseño de Sistemas</strong> - <strong>UTN-FRBA</strong>.
            </div>
            <div>
                <strong>Copyright</strong> ¿Dónde Invierto? &copy; 2017-2017
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

@yield('scripts')

</body>

</html>
