@extends ('master')
@section ('title','Ver Metodología')
@section ('head')
<link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
<link href="{{asset('js/plugins/sweetalert/dist/sweetalert.css')}}" rel="stylesheet">
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
                  <form method="get" class="form-horizontal" style="margin-top:15px">
                      <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nombre de la metodología" ></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Descripción de la metodología" > <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción de la metodología generada.</span></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                              <div class="checkbox i-checks"><label> <input type="checkbox" value="" checked=""> <i></i> Activo </label></div>
                      </div>
                      <div class="hr-line-dashed"></div>


                      <h4>Reglas</h4>
                        <div class="content col-sm-12">
                          <div class="table responsive">
                              <table class="table table-striped">
                                  <thead>
                                  <tr>
                                      <th>#</th>
                                      <th width="25%">Indicador</th> <!--30-->
                                      <th width="25%">Condición</th> <!--15-->
                                      <th width="10%">Desde</th> <!--10-->
                                      <th width="10%">Hasta</th> <!--10-->
                                      <th width="15%">Modalidad</th> <!--15-->
                                      <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @for($i=1;$i<6;$i++)
                                  <tr class="rule-{{$i}}">
                                      <td><b>{{$i}}</b></td>
                                      <td><select class="form-control indicator" id="indicator">
                                      @for($j=0;$j<=10;$j++)
                                        <option value="ind1">Indicador {{$j}}</option>
                                      @endfor
                                      </td>
                                      <td class="form-inline">
                                        <select class="form-control" style="width:100%" id="condition">
                                          <option value="min">menor</option>
                                          <option value="max">mayor</option>
                                          <option value="minq">menor que</option>
                                          <option value="maxq">mayor que</option>
                                          <option value="asc">creciente</option>
                                          <option value="dec">decreciente</option>
                                        </select>
                                        <input type="text" class="form-control" style="width:0%" value="0" id="value">
                                      </td>
                                      <td><select class="form-control" name="from" id="from">
                                      @for($j=0;$j<7;$j++)
                                        <option value="201{{$j}}">201{{$j}}</option>
                                      @endfor
                                      </td>
                                      <td><select class="form-control" name="to" id="to">
                                      @for($j=0;$j<7;$j++)
                                        <option value="201{{$j}}">201{{$j}}</option>
                                      @endfor
                                      </td>
                                      <td><select class="form-control function" id="function">
                                        <option value="uni">Unitaria</option>
                                        <option value="sum">Sumatoria</option>
                                        <option value="avg">Promedio</option>
                                        <option value="med">Media</option>
                                      </td>
                                      <td>
                                        <button type="button" name="button" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i></button>
                                      </td>

                                  </tr>
                                  @endfor
                                  </tbody>
                              </table>
                              <button type="button" name="button" class="btn btn-md btn-primary col-sm-offset-10"><i class="fa fa-plus"></i> Agregar Regla</button>
                          </div>

                        </div>
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
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#function').attr("disabled",true);
            $('#value').hide()
            bkpFrom=$('#from').val();
            bkpTo=$('#to').val()
       });

    </script>

    <script>
      $('#from, #to').each(function() {
        $(this).data('lastValue', $(this).val());
      });

      $('#from,#to,#condition').change(function(){
        if($('#from').val() != $('#to').val() && $('#condition').val()!='asc' && $('#condition').val()!='dec'){
          $('#function').attr("disabled",false);
        }else{
          $('#function').attr("disabled",true).val("uni");
        }
      })
      $('#from,#to').change(function(){
        var lastPeriod = $(this).data('lastValue');
        var newPeriod = $(this).val();
        if($('#from').val() > $('#to').val()){
          sweetAlert("Oops...", "La fecha final no puede ser menor que la inicial");
          $(this).val(lastPeriod)
        }else {
          $(this).data('lastValue', newPeriod)
        }
      })

      $('#condition').change(function(){
        if(this.value == "minq" || this.value == "maxq"){
          $('#value').show();
          $('#value').width("10%");
          $('#condition').width("36%");
        }else {
          $('#value').hide()
          $('#condition').width("75%");
        }
      })

    </script>
@endsection
