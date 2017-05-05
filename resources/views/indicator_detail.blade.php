@extends ('master')
@section ('title','Editar Indicador')
@section ('head')
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section ('content')
<div class="wrapper wrapper-content animated fadeInUp">
  <div class="row">
      <div class="col-lg-12">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>Editor de indicador</h5>
              </div>
              <div class="ibox-content">
                  <form method="get" class="form-horizontal" name="indicator-form" action="">
                      <div class="form-group"><label class="col-sm-2 control-label">Nombre *</label>
                          <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control" placeholder="Nombre del indicador" ></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-10"><input type="text" name="description" id="description" class="form-control" placeholder="Descripción del indicador" > <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción del indicador generado.</span></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                              <div class="checkbox i-checks"><label> <input type="checkbox" name="status" id="status" value="" checked=""> <i></i> Activo </label></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group" id="formula-group"><label class="col-sm-2 control-label">Fórmula *</label>
                          <div class="col-sm-10">
                            <input name="formula" id="formula" type="text" class="form-control" placeholder="Fórmula del indicador">
                            <span class="help-block m-b-none" id="message"></span>
                          </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <span class="col-sm-2 col-sm-offset-10 help-block"><i>* Campo obligatorio.</i></span>
                      <div class="form-group">
                          <div class="col-sm-4 col-sm-offset-5">
                              <button class="btn btn-white" type="submit">Cancelar</button>
                              <button class="btn btn-primary" onclick="validarFormula()">Guardar</button>
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
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('js/plugins/mathjs/math.min.js')}}"></script>
<script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/indicator-validation.js')}}"></script>

    <script>
      var scope = {},
          formula = "",
          indicators = ["ROI","utilidad","ganancia","Inversion"]; //Indicadores hardcodeados

      $(document).ready(function(){
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
          });
      });

      for (var i = 0; i < indicators.length; i++) {
        indicators[i] = indicators[i].toUpperCase();
        scope[indicators[i]] = 1
      }

      $('#formula').on('input',function(){
        content = $('#formula').val().toUpperCase();
        $('#formula-group').removeClass('has-error');
        $('#message').empty();
        try{
          math.eval(content,scope)}
        catch(e){
          $('#formula-group').addClass('has-error');
          $('#message').text(e.message)
        }
      })
    </script>
@endsection
