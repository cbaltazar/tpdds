@extends ('master')
@section ('title','Ver Metodología')
@section ('head')
<link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section ('content')
<div class="wrapper wrapper-content animated fadeInUp">
  <div class="row">
      <div class="col-lg-12">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>Editor de Metodología</h5>
              </div>
              <div class="ibox-content">
                  <form method="get" class="form-horizontal">
                      <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10"><input type="text" class="form-control" placeholder="Nombre de la metodología" ></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-10"><input type="text" class="form-control" placeholder="Descripción de la metodología" > <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción de la metodología generada.</span></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                              <div class="checkbox i-checks"><label> <input type="checkbox" value="" checked=""> <i></i> Activo </label></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Reglas</label>
                          <div class="col-md-10">
                              <div class="summernote" style="border:1px solid black">
                                  <h4>
                                      <b>(</b><span class="label label-primary">ingresos brutos</span><b>-</b><span class="label label-primary"> ingresos netos</span><b>)</b> <b>/</b> <span class="label label-primary">reintegros</span>
                                  </h4>
                              </div>
                          </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group">
                          <div class="col-sm-4 col-sm-offset-5">
                              <button class="btn btn-white" type="submit">Cancelar</button>
                              <button class="btn btn-primary" type="submit">Guardar</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section ('scripts')
    <script src="{{asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.summernote').summernote();
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
       });
    </script>
@endsection
