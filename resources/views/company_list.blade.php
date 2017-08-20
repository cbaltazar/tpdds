@extends ('master')
@section ('title','Empresas')
@section ('head')
<link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('js/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection
@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
<!--upload modal-->
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
                                <input type="submit" value="Aceptar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--fin modal-->

            <div class="ibox animated">
                <div class="ibox-title">
                    <h5>Listado de Empresas</h5>
                    <div class="ibox-tools">
                      <a href="{{ url('methodEval') }}" class="btn btn-primary btn-sm"><i class="fa fa-tachometer"></i> Evaluar </a>
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"></i> Cargar</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="project-list">
                        <table class="table table-hover" id=table>
                            <tbody>
                            @if( count($empresas) > 0)
                                @foreach($empresas as $empresa)
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('companyDetail/'.$empresa->id) }}">{{ $empresa->nombre }}</a>
                                            <br/>
                                            <small>Creada el {{ $empresa->created_at }}</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="{{ url('companyDetail/'.$empresa->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="" id="{{ $empresa->id }}" data-toggle="modal" data-target="#confirmModal" class="btn btn-white btn-sm btn-delete"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No se encontraron cuentas cargadas</p>
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
<script src="{{asset('js/plugins/fileStyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/messenger.js')}}"></script>
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
    window.location = "{{ url('deleteCompany/')}}"+"/"+id;
  });
});
</script>
@endsection
