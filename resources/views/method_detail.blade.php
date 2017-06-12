@extends ('master')
@section ('title','Ver Metodología')
@section ('head')
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
                                      <th>Función</th>
                                      <th>Indicador</th>
                                      <th>Condición</th>
                                      <th>Valor</th>
                                      <th>Desde</th>
                                      <th>Hasta</th>
                                      <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @for($i=1;$i<6;$i++)
                                  <tr>
                                      <td><b>{{$i}}</b></td>
                                      <td><select class="form-control function">
                                        <option value="uni">Unitario</option>
                                        <option value="sum">Sumatoria</option>
                                        <option value="avg">Promedio</option>
                                        <option value="med">Media</option>
                                      </td>
                                      <td><select class="form-control indicator">
                                      @for($j=0;$j<=10;$j++)
                                        <option value="ind1">Indicador {{$j}}</option>
                                      @endfor
                                      </td>
                                      <td><select class="form-control">
                                        <option value="mix">menor</option>
                                        <option value="max">mayor</option>
                                        <option value="minq">menor que</option>
                                        <option value="maxq">mayor que</option>
                                      </td>
                                      <td><input type="text" class="form-control" value="1000"></td>
                                      <td><select class="form-control">
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                      </td>
                                      <td><select class="form-control">
                                        <option value="mix">2013</option>
                                        <option value="max">2014</option>
                                        <option value="minq">2015</option>
                                        <option value="maxq">2016</option>
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
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
       });
    </script>
@endsection
