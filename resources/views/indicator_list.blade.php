@extends ('master')
@section ('title','Indicadores')
@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif
            <!--confirm modal-->
                        <div class="modal inmodal fade" id="confirmModal" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Confirmar acción</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Está seguro de que desea <strong>Eliminar</strong> este Indicador?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                                        <a type="button" class="btn btn-primary confirm" href="">Aceptar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <!--fin modal-->

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
  <script>
      $(document).ready(function () {
          setTimeout(function () {
              $(".alert-success").slideUp(1500);
          }, 2000);
      });
      $(".btn-delete").click(function(e){
        $(".confirm").attr('href',"{{ url('indicatorDelete/')}}"+"/"+$(this).attr('id'));
      })
  </script>
@endsection
