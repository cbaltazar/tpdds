<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Dónde Invierto? | @yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
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
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">¿Dónde invierto?</strong>
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
                    <div class="logo-element">
                        DI?
                    </div>
                </li>
                <li> <!--class="active"-->
                    <a href="index.html"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Cuentas</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="index.html">Resumen</a></li>
                        <li><a href="{{ url('loadAccount') }}">Cargar cuentas</a></li>
                        <li><a href="dashboard_3.html">Analizar cuentas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-calculator"></i> <span class="nav-label">Indicadores</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="graph_flot.html">Ver indicadores</a></li>
                        <li><a href="graph_morris.html">Crear indicadores</a></li>
                        <li><a href="graph_rickshaw.html">Analizar gráficos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Metodologías</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="form_basic.html">Cargar metodología</a></li>
                        <li><a href="form_advanced.html">Analizar metodología</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                </ul>
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>@yield('title')</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        <strong>@yield('title')</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">

            @yield('content')

        </div>
        <div class="footer">
            <div class="pull-right">
                Desarrollado para la cátedra de <strong>Diseño de Sistemas</strong> de la <strong>UTN-FRBA</strong>.
            </div>
            <div>
                <strong>Copyright</strong> AMEVA &copy; 2017-2017
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

<script>
    $(document).ready(function () {

        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)

            // Ajax example
            //                $.ajax().always(function () {
            //                    simpleLoad($(this), false)
            //                });

            simpleLoad(btn, false)
        });
    });

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }

    var fn = function(e) {
        if (!/zmore/.test(e.target.className)) { $('#dmore').hide(); }
    }
    document.addEventListener('click', fn);
    document.addEventListener('touchstart', fn);

</script>

</body>

</html>
