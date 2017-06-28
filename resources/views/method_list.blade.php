@extends ('master')
@section ('title','Metodologías')
@section ('head')
<link href="{{asset('js/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status')['msg'] }}</div>
            @endif

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Listado de Metodologías</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('methodEval') }}" class="btn btn-primary btn-sm"><i class="fa fa-tachometer"></i> Aplicar</a>
                        <a href="{{ url('methodDetail') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover" id="table">
                            <tbody>
                            @if( count($methodologies) > 0 )
                            @foreach( $methodologies as $methodology)
                            <tr>
                                <td class="project-status">
                                    <span class="label @if( $methodology->activo == 1) label-primary"> Activo @else label-plain"> Inactivo @endif</span>
                                </td>
                                <td class="project-title">
                                    <a href="{{ url('methodDetail/'.$methodology->id) }}">{{ $methodology->nombre }}</a>
                                    <br/>
                                    <small>Creado el {{ $methodology->created_at }}</small>
                                </td>
                                <td class="project-actions">
                                    <a href="{{ url('methodDetail/'.$methodology->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                    <a href="" id="{{ $methodology->id }}" data-toggle="modal" data-target="#confirmModal" class="btn btn-white btn-sm btn-delete"><i class="fa fa-trash"></i> Borrar </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                No hay metodologias cargadas.
                            @endif
                            </tbody>
                        </table>
                        <div style="text-align:center">
                            <div class="btn-group" id="paginator"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{asset('js/plugins/paginator/paginator.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert").slideUp(1500);
            }, 2000);
        });

        $(".btn-delete").click(function(){
          var id=$(this).attr('id');
          swal({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true
          },
          function(){
            window.location = "{{ url('deleteMethodology/')}}"+"/"+id;
          });
        });
    </script>
@endsection
