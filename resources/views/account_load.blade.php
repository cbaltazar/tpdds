@extends ('master')
@section ('title','Cargar Cuentas')
@section ('head')
<link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection
@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            @if ( Request::get('err') != null)
                <div class="alert
                @if(Request::get('err') == 0)
                    alert-success"> Archivo cargado correctamente.
                @else
                    alert-danger"> Se ha producido un error al cargar el archivo. Vuelva a intentarlo.
                @endif
                </div>
            @endif
<!---->
            <div class="modal inmodal fade" id="uploadModal" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Cargar Cuentas</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="{{url('store')}}">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p>Seleccione un archivo para cargar las <strong>Cuentas</strong> que desee procesar.</p>
                                <input type="file" name="file" class="filestyle" data-buttonText=" Seleccionar Archivo" data-buttonName="btn-primary" data-placeholder="Seleccione un archivo...">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                                <input type="submit" value="Cargar Cuentas" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!---->
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Listado de Empresas</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-plus"></i> Cargar cuentas</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>
                            @if( count($empresas) > 0)
                                @foreach($empresas as $empresa)
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('accountDetail/'.$empresa) }}">{{ $empresa }}</a>
                                            <br/>
                                            <small>Created at {{ $created }}</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="{{ url('accountDetail/'.$empresa) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="{{ url('accountDetail/'.$empresa) }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No se encontraron cuentas cargadas</p>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



<!---->
        </div>
    </div>
@endsection

@section ('scripts')
<!-- FileStyle -->
<script src="{{asset('js/plugins/fileStyle/bootstrap-filestyle.min.js')}}"></script>
<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function () {
      setTimeout(function() {
          toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: 'slideDown',
              timeOut: 4000
          };
          toastr.success('Tu asesor de inversiones online', 'Bienvenido a ¿Dónde Invierto?');
      }, 1300);

        setTimeout(function () {
            $(".alert-success").fadeOut(1500);
        }, 2000);
    });
</script>
@endsection
