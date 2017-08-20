@extends ('master')
@section ('title','Evaluar Empresas')
@section ('head')
    <link href="{{asset('js/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
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
                                <td><input type="checkbox" checked class="js-switch companyName" id="{{ $company->id }}"></td>
                                <td style="vertical-align:middle">{{ $company->nombre }}</td>
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
                  <td class="project-status" style="32%">
                      <h5 style="font-size:14px">Metodología de evaluación:</h5>
                  </td>
                  <td class="project-title" style="padding:13px 10px; width:37%">
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
                      <td></td>
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
    <script src="{{asset('js/plugins/switchery/switchery.min.js')}}"></script>
    <script>
        function prepareParams(){
            params = {};
            params.companies = [];
            $('.companyToEvaluate').each(function(index, item){
                if( $(item).find(':checked').length === 1 ){
                    params.companies.push($(item).find('.companyName').attr('id'));
                }
            });
            params.methodology = $("#selectedMethodology").val();
            return params;
        }

        function setStyle(position,icon,color){
          position.children().last().addClass(color).append("%");
          position.find("i").addClass(icon);
        }

        function valorationStylize(avg){
          var positions = $("#companiesEvaluated tr");
          var N = positions.size();
          var value;

          for(var i=0; i<N; i++){
            value = $(positions[i]).children().last().text();
            if(value>=avg){
              setStyle($(positions[i]),"fa-long-arrow-up", "text-navy")}
            else if(value>=avg/2){
              setStyle($(positions[i]),"fa-level-down", "text-warning")}
            else {
              setStyle($(positions[i]),"fa-long-arrow-down", "text-danger")}
          }
        }

        function drawEvaluatedCompanies(obj){
            $("#companiesEvaluated").empty();
            var i = 1;
            var tableBody = '';
            var sum=0,avg=0;
            if(Object.keys(obj).length > 0){
                $.each(obj, function(name, valoration){
                    tableBody += '<tr>' +
                        '<td>'+ i +'</td>' +
                        '<td>'+ name +'</td>' +
                        '<td><i class="fa"> </i> '+ valoration +'</td></tr>';
                    i++;
                    sum += parseInt(valoration);
                });
                avg = sum/Object.keys(obj).length
            }else{
                tableBody = '<tr>' +
                    '<td></td>' +
                    '<td> No existen empresas que cumplan con el criterio seleccionado.</td>'+
                    '<td></td></tr>';
            }
            $("#companiesEvaluated").append( tableBody );
            if (avg!=0) {
              valorationStylize(avg);
            }
        }

        function evaluateMethodology( params ){
            $.ajax({
                url: '/api/methodologyEvaluate',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params),
                success: function ( obj ) {
                    drawEvaluatedCompanies(obj);
                }
            });
        }

        $(document).ready(function(){
            $('#applyMethodology').click(function(){
               var params = prepareParams();
               console.log(JSON.stringify(params));
               evaluateMethodology( params );
            });

            $("#editButton").attr("href","methodDetail/"+$("#selectedMethodology").val());
            $('#selectedMethodology').on('change',function(){
                $("#editButton").attr("href","methodDetail/"+$("#selectedMethodology").val());
            });

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
              var switchery = new Switchery(html,{color: '#1ab394', size: 'small'});
            });
       });
    </script>
@endsection
