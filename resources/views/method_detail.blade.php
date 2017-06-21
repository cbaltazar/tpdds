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
          @if (session('status'))
              <div class="alert  alert-danger">
                    {{ session('status') }}
                </div>
          @endif
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>Editor de Metodología</h5>
              </div>
              <div class="ibox-content">
                  <form method="post" class="form-horizontal" style="margin-top:15px" id="methodology-form" action="{{ url('saveMethodology') }}/{{ $methodologyObject->id or "" }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nombre de la metodología" id="nombre" value="{{$methodologyObject->nombre or " "}}"></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Descripción de la metodología" id="descripcion" value="{{$methodologyObject->descripcion or " "}}"> <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción de la metodología generada.</span></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                              <div class="checkbox i-checks"><label> <input type="checkbox" value="" @if($methodologyObject != null and $methodologyObject->activo ==1) checked @endif id="estado">
                                      <i></i> Activo </label></div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <h4>Reglas</h4>
                        <div class="content col-sm-12">
                          <div class="table responsive">
                              <table class="table table-striped" id="rules">
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
                                    @if( $methodologyObject != null && count($methodologyObject->reglas) > 0 )
                                        <input type="hidden" id="methodologyObject" value="{{ count($methodologyObject->reglas)+1 }}" />
                                           @foreach($methodologyObject->reglas as $key=>$regla)
                                               <tr class='rule' id='{{ $key+1 }}'>
                                                   <td>
                                                       <b class='ruleId'>{{ $key+1 }}</b>
                                                   </td>
                                                   <td>
                                                       <select class='form-control element'>
                                                           @foreach($elements as $elem)
                                                                <option value='{{ $elem->nombre }}' @if($regla->elemento == $elem->nombre) selected @endif>{{ $elem->nombre }}</option>
                                                           @endforeach
                                                       </select>
                                                   </td>
                                                   <td class='form-inline'>
                                                       <select class='form-control condition'
                                                               @if( explode(",",$regla->condicion)[0] == 'minq' || explode(",",$regla->condicion)[0] == 'maxq' )
                                                               style='width:62%'
                                                           @else
                                                               style='width:100%'
                                                           @endif
                                                            />
                                                           <option value='min' @if($regla->condicion == 'min') selected @endif>menor</option>
                                                           <option value='max' @if($regla->condicion == 'max') selected @endif>mayor</option>
                                                           <option value='minq' @if(explode(",",$regla->condicion)[0] == 'minq') selected @endif >menor que</option>
                                                           <option value='maxq' @if(explode(",",$regla->condicion)[0] == 'maxq') selected @endif >mayor que</option>
                                                           <option value='asc' @if($regla->condicion == 'asc') selected @endif>creciente</option>
                                                           <option value='dec' @if($regla->condicion == 'dec') selected @endif>decreciente</option>
                                                       </select>
                                                       @if( explode(",",$regla->condicion)[0] == 'minq' || explode(",",$regla->condicion)[0] == 'maxq' )
                                                       <input type='text' class='form-control value' name='valueToCompare' style='width:36%; display: inline;' value="{{ explode(",",$regla->condicion)[1] }}">
                                                           @else
                                                           <input type='text' class='form-control value' name='valueToCompare' style='width:0%; display: none;'>
                                                       @endif
                                                   </td>

                                                   <td>
                                                       <select class='form-control from' name='from'>
                                                           <option value='2010' @if($regla->desde == '2010') selected @endif>2010</option>
                                                           <option value='2011' @if($regla->desde == '2011') selected @endif>2011</option>
                                                           <option value='2012' @if($regla->desde == '2012') selected @endif>2012</option>
                                                           <option value='2013' @if($regla->desde == '2013') selected @endif>2013</option>
                                                           <option value='2014' @if($regla->desde == '2014') selected @endif>2014</option>
                                                           <option value='2015' @if($regla->desde == '2015') selected @endif>2015</option>
                                                           <option value='2016' @if($regla->desde == '2016') selected @endif>2016</option>
                                                           <option value='2017' @if($regla->desde == '2017') selected @endif>2017</option>
                                                       </select>
                                                   </td>

                                                   <td>
                                                       <select class='form-control to' name='to'>
                                                           <option value='2010' @if($regla->hasta == '2010') selected @endif>2010</option>
                                                           <option value='2011' @if($regla->hasta == '2011') selected @endif>2011</option>
                                                           <option value='2012' @if($regla->hasta == '2012') selected @endif>2012</option>
                                                           <option value='2013' @if($regla->hasta == '2013') selected @endif>2013</option>
                                                           <option value='2014' @if($regla->hasta == '2014') selected @endif>2014</option>
                                                           <option value='2015' @if($regla->hasta == '2015') selected @endif>2015</option>
                                                           <option value='2016' @if($regla->hasta == '2016') selected @endif>2016</option>
                                                           <option value='2017' @if($regla->hasta == '2017') selected @endif>2017</option>
                                                       </select>
                                                   </td>

                                                   <td>
                                                       <select class='form-control function'>
                                                           <option value='uni' @if($regla->modalidad == 'uni') selected @endif>Unitaria</option>
                                                           <option value='sum' @if($regla->modalidad == 'sum') selected @endif>Sumatoria</option>
                                                           <option value='avg' @if($regla->modalidad == 'avg') selected @endif>Promedio</option>
                                                           <option value='med' @if($regla->modalidad == 'med') selected @endif>Media</option>
                                                       </select>
                                                   </td>
                                                   <td>
                                                       <button type='button' name='button' class='btn btn-sm btn-warning deleteRule'><i class='fa fa-trash'></i></button>
                                                   </td>
                                               </tr>
                                           @endforeach
                                        @else

                                        @endif
                                  </tbody>
                              </table>
                              <button type="button" name="button" class="btn btn-md btn-primary col-sm-offset-10" id="addRule"><i class="fa fa-plus"></i> Agregar Regla</button>
                          </div>

                        </div>
                      <div class="form-group">
                          <div class="col-sm-4 col-sm-offset-5">
                              <input type="button" class="btn btn-white" onclick="location.href='{{URL::previous()}}';" value="Cancelar" name="cancel"></input>
                              <button class="btn btn-primary" type="submit">Guardar</button>
                          </div>
                      </div>
                      <input type="hidden" name="jsonData" id="jsonData">
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
        var ruleId=1;
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            if( $("#methodologyObject").val() == undefined){
                createRuleRow(ruleId);
            }else{
                ruleId = parseInt($("#methodologyObject").val());
            }

            setTimeout(function () {
                $(".alert").slideUp(1500);
            }, 2000);
        });

        //--------campo value------------------
        $('body').on('change','.condition', function(){
            var rowId ='#'+ $(this).parent().parent().attr('id');
            if(this.value == "minq" || this.value == "maxq"){
                $(rowId+' .value').show().width("10%");
                $(rowId+' .condition').width("36%");
            }else {
                $(rowId+' .value').hide()
                $(rowId+' .condition').width("75%");
            }
        })
        //-----------DATE-VALIDATOR--------------------------
        $('body').on('change','.from,.to',function(){
            var rowId = $(this).parent().parent().attr('id');
            var lastPeriod = $(this).data('lastPeriod');
            var newPeriod = $(this).val();

            if($('#'+rowId+' .from').val() > $('#'+rowId+' .to').val()){
                sweetAlert("Ups...", "La fecha final no puede ser menor que la inicial");
                $(this).val(lastPeriod)
            }else {
                $(this).data('lastPeriod', newPeriod)
            }
        })
        //-----------MODALIDAD VALIDATOR--------------------------
        $('body').on('change','.from,.to,.condition', function(){
            var rowId ='#'+ $(this).parent().parent().attr('id');
            if($(rowId+' .from').val() != $(rowId+' .to').val() && $(rowId+' .condition').val()!='asc' && $(rowId+' .condition').val()!='dec'){
                $(rowId+' .function').attr("disabled",false);
            }else{
                $(rowId+ ' .function').attr("disabled",true).val("uni");
            }
        });
        //----------DELETE RULE------------------
        $('body').on('click','.deleteRule',function(){
            var i;

            if ($('#rules .rule').length>1) {
                rowId= $(this).parent().parent().attr('id');
                $('#'+rowId).remove()
                for (i = 0; i < $('#rules .rule').length; i++) {
                    $($('#rules .rule')[i]).find('.ruleId').html(i+1)
                    $($('#rules .rule')[i]).attr('id',i);
                };
                ruleId = i+1 //que proxima que se genere parta del id de la ultima
            }else{
                sweetAlert("Ups...", "Necesitas al menos una regla");
            };
        });
        //----------CREATE RULE-----
        $("#addRule").click(function(){
            createRuleRow(ruleId)
        });

        function createRuleRow(){
            var elements = JSON.parse('{!! json_encode($elements) !!}');

            var htmlText = "<tr class='rule' id='"+ruleId+"'>"+
                "<td><b class='ruleId'>"+ruleId+" </b></td>"+
                "<td><select class='form-control element'>";

            elements.forEach(function ( item ) {
                htmlText += "<option value='"+ item.nombre +"'>"+item.nombre+"</option>";
            });

            htmlText += "</select></td>"+
                "<td class='form-inline'>"+
                "<select class='form-control condition' style='width:100%'>"+
                "<option value='min'>menor</option>"+
                "<option value='max'>mayor</option>" +
                "<option value='minq'>menor que</option>"+
                "<option value='maxq'>mayor que</option>"+
                "<option value='asc'>creciente</option>"+
                "<option value='dec'>decreciente</option>"+
                "</select>";

            htmlText += "<input type='text' class='form-control value' name='valueToCompare' style='width:0%; display: none;'></td>"+
                "<td><select class='form-control from' name='from'>";
            for(var j=0;j<=7;j++){
                htmlText += "<option value='201"+j+"'>201"+j+"</option>";
            }

            htmlText += "</select></td>"+
                "<td><select class='form-control to' name='to'>";

            for(var j=0;j<=7;j++){
                htmlText += "<option value='201"+j+"'>201"+j+"</option>";
            }

            htmlText += "</select></td>"+
                "<td>" +
                "<select class='form-control function'>"+
                "<option value='uni'>Unitaria</option>"+
                "<option value='sum'>Sumatoria</option>"+
                "<option value='avg'>Promedio</option>"+
                "<option value='med'>Media</option>"+
                "</select>"+
                "</td>";

            htmlText += "<td>"+
                "<button type='button' name='button' class='btn btn-sm btn-warning deleteRule'><i class='fa fa-trash'></i></button>"+
                "</td>"+
                "</tr>";

            $("#rules").append( htmlText );

            $('#'+ruleId+'>td>.function').attr("disabled",true);
            $('#'+ruleId+'>td>.value').hide();
            $('#'+ruleId+' .from').data('lastPeriod', $('#'+ruleId+' .from').val());
            $('#'+ruleId+' .to').data('lastPeriod', $('#'+ruleId+' .to').val());
            ruleId++;
        }

        $('#methodology-form').submit(function(){
            var methodology = prepareRequest();
            $("#jsonData").val(JSON.stringify(methodology));
            console.log( $("#jsonData").val() );
        });

        function prepareRequest(){
            var methodology = {};
            methodology.name = $("#nombre").val();
            methodology.description = $("#descripcion").val();
            methodology.status = ($("#estado").is(':checked')) ? 1 : 0;
            methodology.rules = [];

            var rows = $("#rules").children('tbody').children('tr');
            rows.each(function( key, item ){
                var rule = {};
                rule.element = $(item).find('.element').val();

                if($(item).find('.condition').val() == 'minq' || $(item).find('.condition').val() == 'maxq' ){
                    rule.condition = $(item).find('.condition').val()+","+$(item).find('.value').val();
                }else{
                    rule.condition = $(item).find('.condition').val();
                }
                rule.period = {};
                rule.period.from = $(item).find('.from').val();
                rule.period.to = $(item).find('.to').val();
                rule.mode = $(item).find('.function').val();

                methodology.rules.push( rule );
            });

            return methodology;
        }

    </script>
@endsection