@extends ('master')
@section ('title','Indicadores')
@section ('head')
<link href="{{asset('js/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Listado de Indicadores</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('indicatorDetail') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover" id="table">
                            <tbody>
                            @if( count($indicators) > 0)
                                @foreach($indicators as $indicator)
                                    <tr>
                                        <td class="project-status">
                                            <span class="label
                                                @if( $indicator->predefinido == 1) label-danger"> Predefinido
                                                @else
                                                @if( $indicator->activo == 1) label-primary"> Activo @else label-plain"> Inactivo @endif
                                                @endif
                                            </span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail/'.$indicator->id) }}">{{ $indicator->nombre }}</a>
                                            <br/>
                                            <small>Creado el {{ $indicator->created_at }}</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="{{ url('indicatorDetail/'.$indicator->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="" id="{{$indicator->id}}" data-toggle="modal" data-target="#confirmModal" class="btn btn-white btn-sm btn-delete" @if( $indicator->predefinido) disabled @endif><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No se encontraron indicadores cargados</p>
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
              $(".alert-success").slideUp(1500);
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
          window.location = "{{ url('indicatorDelete/')}}"+"/"+id;
        });
      });
  </script>
@endsection
