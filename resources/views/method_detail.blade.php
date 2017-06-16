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
                  <form method="get" class="form-horizontal" style="margin-top:15px" id="methodology-form">
                      <div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nombre de la metodología" id="nombre"></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-9"><input type="text" class="form-control" placeholder="Descripción de la metodología" id="descripcion" > <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción de la metodología generada.</span></div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                              <div class="checkbox i-checks"><label> <input type="checkbox" value="" checked="" id="estado"> <i></i> Activo </label></div>
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
                                  <tbody></tbody>
                              </table>
                              <button type="button" name="button" class="btn btn-md btn-primary col-sm-offset-10" id="addRule"><i class="fa fa-plus"></i> Agregar Regla</button>
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

    var ruleId=1;
      $(document).ready(function(){
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
          });
          createRuleRow(ruleId);
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
          console.log(elements);

          var htmlText = "<tr class='rule' id='"+ruleId+"'>"+
                         "<td><b class='ruleId'>"+ruleId+"</b></td>"+
                         "<td><select class='form-control element'>";

          elements.forEach(function ( item ) {
             htmlText += "<option value='"+ item.nombre +"'>"+item.nombre+"</option>";
          });

          htmlText += "<\td>"+
                      "<td class='form-inline'>"+
                      "<select class='form-control condition' style='width:100%'>"+
                        "<option value='min'>menor</option>"+
                        "<option value='max'>mayor</option>" +
                        "<option value='minq'>menor que</option>"+
                        "<option value='maxq'>mayor que</option>"+
                        "<option value='asc'>creciente</option>"+
                        "<option value='dec'>decreciente</option>"+
                      "</select>";

          htmlText += "<input type='text' class='form-control value' style='width:0%'></td>"+
                      "<td><select class='form-control from' name='from'>";
          for(var j=0;j<7;j++){
              htmlText += "<option value='201"+j+"'>201"+j+"</option>";
          }

          htmlText += "</td>"+
                      "<td><select class='form-control to' name='to'>";

          for(var j=0;j<7;j++){
              htmlText += "<option value='201"+j+"'>201"+j+"</option>";
          }

          htmlText += "</td>"+
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

        saveMethodology( methodology );

        alert( "Handler for .submit() called." );

        event.preventDefault();
    });

      function saveMethodology( data ){
          $.ajax({
              url: '/api/saveMethodology',
              type: 'post',
              dataType: 'json',
              data: JSON.stringify(data),
              success: function( obj ) {
                console.log(obj);
              },
              error: function( obj ){
                  console.log(obj);
              }
          });
      }

      function prepareRequest(){
          var methodology = {};
          methodology.nombre = $("#nombre").val();
          methodology.descripcion = $("#descripcion").val();
          methodology.estado = ($("#estado").is(':checked')) ? 1 : 0;
          methodology.reglas = [];

          var rows = $("#rules").children('tbody').children('tr');
          rows.each(function( key, item ){
              var rule = {};
              rule.elemento = $(item).find('.element').val();
              rule.condicion = $(item).find('.condition').val();
              rule.periodo = {};
              rule.periodo.desde = $(item).find('.from').val();
              rule.periodo.hasta = $(item).find('.to').val();
              rule.modalidad = $(item).find('.function').val();

              methodology.reglas.push( rule );
          });

          return methodology;
      }

  </script>
@endsection
