@extends ('master')
@section ('title','Evaluar Empresas')
@section ('head')
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('js/plugins/sweetalert/dist/sweetalert.css')}}" rel="stylesheet">
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
                                        <input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
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
                      <a href="{{ url('methodDetail/'.$methodology->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                  </td>
                  <td class="project-actions">
                      <a href="#" class="btn btn-primary btn-sm" id="applyMethodology"><i class="fa fa-check"></i> Aplicar</a>
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
                    <th>Empresa</th>
                    <th>Valoración</th>
                </tr>
                </thead>
                <tbody>
                @for($i=1;$i<6;$i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>Empresa {{$i}}</td>
                    <td class="text-navy" style="width:100px"> <i class="fa fa-level-up"></i> {{(5-$i)*10}}% </td>
                </tr>
                @endfor
                @for($i=6;$i<11;$i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>Empresa {{$i}}</td>
                    <td class="text-warning"> <i class="fa fa-level-down"></i> -{{($i)*10}}% </td>
                </tr>
                @endfor
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
            console.log(JSON.stringify(params));
            return params;
        }

        function evaluateMethodology( params ){

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
       });
    </script>
@endsection
