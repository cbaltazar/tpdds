@extends ('master')
@section ('title','Cuentas')
@section ('head')
<!-- Toastr style -->
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
                                <div class="alert @if(Request::get('err') == 0) alert-success @else alert-danger @endif">
                                    @if(Request::get('err') == 0)
                                        Archivo cargado correctamente!!!
                                    @else
                                        Error al cargar el archivo!
                                    @endif
                                </div>
                            @endif

                            <div class="col-sm-7 col-xs-12">
                                <form method="post" enctype="multipart/form-data" action="{{url('store')}}">
                                    {{csrf_field()}}
                                    <input type="file" name="file">
                                    <br>
                                    <input type="submit" value="Cargar Cuentas">
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
