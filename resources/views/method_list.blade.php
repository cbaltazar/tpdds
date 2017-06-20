@extends ('master')
@section ('title','Metodologías')
@section ('content')
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    @if (session('status'))
                        <div class="alert  alert-success">
                            {{ session('status')['msg'] }}
                        </div>
                    @endif
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listado de Metodologías</h5>
                            <div class="ibox-tools">
                                <a href="{{ url('methodDetail') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear metodología</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!--div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div-->
                            <div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
                                    @if( count($methodologies) > 0 )
                                    @foreach( $methodologies as $methodology)
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('methodDetail/'.$methodology->id) }}">{{ $methodology->nombre }}</a>
                                            <br/>
                                            <small>Creado el {{ $methodology->created_at }}</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="{{ url('methodDetail/'.$methodology->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        No hay metodologias cargadas.
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section ('scripts')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert").slideUp(1500);
            }, 2000);
        });
    </script>
@endsection