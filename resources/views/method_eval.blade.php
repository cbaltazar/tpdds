@extends ('master')
@section ('title','Evaluar Empresas')
@section ('head')
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section ('content')
<div class="wrapper wrapper-content animated fadeInUp">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Empresas a evaluar</h5>
          </div>
          <div class="ibox-content">
              <div class="table-responsive">
                  <table class="table table-striped">
                      <tbody id="companiesList">
                      @if( count($companies) > 0 )
                        @foreach($companies as $company)
                            <tr class="companyToEvaluate">
                                <td>
                                    <div class="icheckbox_square-green" style="position: relative;">
                                        <input type="checkbox" checked class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
                                        <input type="hidden" class="companyName" id="{{ $company->id }}">
                                    </div>
                                </td>
                                <td>{{ $company->nombre }}</td>
                            </tr>
                            @endforeach
                        @else
                          <tr>
                              <td>No hay empresas para evaluar.</td>
                          </tr>
                      @endif
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
  <div class="col-lg-8">
    <div style="background:#e7eaec; padding:0px 20px; margin-bottom:20px;">
      <div class="project-list">
      <table class="table">
        <tbody>
          <tr>
                  @if( count($methodologies)>0 )
                  <td class="project-status">
                      <h5 style="font-size:14px">Metodología de evaluación:</h5>
                  </td>
                  <td class="project-title" style="padding:13px 10px">
                    <select class="form-control" id="selectedMethodology">
                      @foreach( $methodologies as $methodology)
                          <option value="{{ $methodology->id }}" > {{ $methodology->nombre }}</option>
                          @endforeach
                    </select>
                  </td>
                  <td>
                      <a id="editButton" href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                  </td>
                  <td class="project-actions">
                      <a href="#" class="btn btn-primary btn-sm" id="applyMethodology"><i class="fa fa-check"></i> Aplicar </a>
                  </td>
                      @else
                      <td>
                          No hay metodologías cargadas.
                      </td>
                  <td class="project-actions">
                        <a href="{{ url('methodDetail') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Cargar </a>
                  </td>
                  @endif
          </tr>
        </tbody>
      </table>
      </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th width=520>Empresa</th>
                    <th>Valoración</th>
                </tr>
                </thead>
                <tbody id="companiesEvaluated">
                    <tr>
                      <td></td>
                      <td>No se han realizado valoraciones.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section ('scripts')
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        function prepareParams(){
            params = {};
            params.companies = [];

            $('.companyToEvaluate').each(function(index, item){
                if( $(item).find('.checked').length === 1 ){
                    params.companies.push($(item).find('.companyName').attr('id'));
                }
            });
            params.methodology = $("#selectedMethodology").val();
            return params;
        }

        function drawEvaluatedCompanies(obj){
            $("#companiesEvaluated").empty();
            var i = 1;
            var tableBody = '';

            if(Object.keys(obj).length > 0){
                $.each(obj, function(name, valoration){
                    tableBody += '<tr>' +
                        '<td>'+ i +'</td>' +
                        '<td>'+ name +'</td>' +
                        '<td><i class="fa"> </i>'+' '+valoration +'</td></tr>';
                    i++;
                });
            }else{
                tableBody = '<tr>' +
                    '<td>'+ i +'</td>' +
                    '<td>'+ "No hay empresas que cumplan con el criterio seleccionado" +'</td></tr>';
            }
            $("#companiesEvaluated").append( tableBody );
        }

        function evaluateMethodology( params ){
            $.ajax({
                url: '/api/methodologyEvaluate',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params),
                success: function ( obj ) {
                    drawEvaluatedCompanies(obj);
                    rankingStylize();
                }
            });
        }

        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#applyMethodology').click(function(){
               var params = prepareParams();
               evaluateMethodology( params );
            });



            $("#editButton").attr("href","methodDetail/"+$("#selectedMethodology").val());
       });

       $('body').on('change load','#selectedMethodology',function(){
         $("#editButton").attr("href","methodDetail/"+$("#selectedMethodology").val());
       });


       function rankingStylize(){
         var rankeds = $("#companiesEvaluated tr");
         var N = rankeds.size();
         for(var i=0; i<N; i++){
           if(i<N/4){
             setStyle($(rankeds[i]),"fa-long-arrow-up", "text-navy");
           }else if (i<(N/4)*2){
             setStyle($(rankeds[i]),"fa-level-up", "text-warning");
           }else if (i<(N/4)*3){
             setStyle($(rankeds[i]),"fa-level-down", "text-warning");
           }else {
             setStyle($(rankeds[i]),"fa-long-arrow-down", "text-danger");
           }
         }
       }

       function setStyle(position,icon,color){
         var valoration = position.children().last();
         valoration.addClass(color);
         valoration.find("i").addClass(icon);
       }

    </script>
@endsection
