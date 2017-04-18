@extends ('master')
@section ('title','Cargar Cuentas')
@section ('head')
<link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection
@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="container-fluid">
                <div style="min-height:60px;padding:12px 0">
                    <div id="contentWrapper">
                        <div class="row">
                          @if ( Request::get('err') != null)
                              <div class="alert
                              @if(Request::get('err') == 0)
                                  alert-success"> Archivo cargado correctamente.
                              @else
                                  alert-danger"> Se ha producido un error al cargar el archivo. Vuelva a intentarlo.
                              @endif
                              </div>
                          @endif
                            <div class="col-sm-7 col-xs-12">
                                <form method="post" enctype="multipart/form-data" action="{{url('store')}}">
                                    {{csrf_field()}}
                                    <input type="file" name="file" class="filestyle" data-buttonText="Seleccionar Archivo" data-buttonName="btn-primary" data-placeholder="Seleccione un archivo...">
                                    <input type="submit" value="Cargar Cuentas" class="btn btn-primary m-t">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    });
</script>
@endsection
