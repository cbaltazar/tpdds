@extends ('master')
@section ('title', $companyName)
@section ('head')
<link href="{{asset('css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.styles.css')}}" rel="stylesheet">
@endsection

@section ('content')
        <div class="wrapper wrapper-content animated fadeInRight">
          <div class="row">
              <div class="col-lg-6">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Cuentas</h5>
                      <!--div class="ibox-tools">
                          <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                          </a>
                      </div-->
                  </div>
                  <div class="ibox-content" style="padding-top:12px">

                  <table class="table table-striped table-bordered table-hover dataTable" >
                  <thead>
                  <tr>
                      <th>Period</th>
                      <th>Account</th>
                      <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if( count($companyAccounts) > 0)
                      @foreach($companyAccounts as $account)
                          <tr>
                              <td>{{ $account->pivot->periodo }}</td>
                              <td>{{ $account->nombre }}</td>
                              <td>{{ $account->pivot->monto }}</td>
                          </tr>
                      @endforeach
                  @endif

                  </tbody>
                  <tfoot>
                  </tfoot>
                  </table>

                  </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Indicadores</h5>
                    <div class="ibox-tools">
                      <h5 style="margin-right:20px">Periodo:</h5>
                      <select class="form-control input-sm" id="indicatorPeriod" style="width:80px">
                        @foreach($indicatorsPeriods as $indicatorPeriod)
                          <option value={{$indicatorPeriod->periodo}}>{{$indicatorPeriod->periodo}}</option>
                        @endforeach
                      </select>
                    </div>


                    <!--div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div-->
                </div>
                <div class="ibox-content" style="padding-top:12px">
                <table class="table table-striped table-bordered table-hover dataTable" >
                <thead>
                <tr>
                    <th>Indicador</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                  @if($indicatorsCount > 0)
                      @for($i=0; $i<$indicatorsCount; $i++)
                          <tr>
                            <td id="name{{$i}}"></td>
                            <td id="value{{$i}}"></td>
                          </tr>
                      @endfor
                  @else
                      <tr>
                          <td>No hay indicadores para calcular.</td>
                          <td></td>
                      </tr>
                  @endif
                </tbody>
                <tfoot>
                </tfoot>
                </table>
                </div>
            </div>
          </div>
          </div>
        </div>
@endsection

@section ('scripts')
<script src="{{asset('js/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>
<script>

$(document).ready(function() {
    calculateIndicator();
    $('#indicatorPeriod').change(function(){
        calculateIndicator();
    });
    prepared=false
});

function prepareDataTable(){
    prepared=true;
    $('.dataTable').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "{{asset('js/plugins/dataTables/swf/copy_csv_xls_pdf.swf')}}",
            "aButtons": [{
                        "sExtends":    "csv",
                        "sButtonText": '<i class="fa fa-download text-muted"></i>',
                      },{
                        "sExtends":    "print",
                        "sButtonText": '<i class="fa fa-print text-muted"></i>',
                      }]
        }
    });
}

function calculateIndicator(){
    $('#indicator-values-container').empty();
    var id = window.location.href.split("/")[4];
    var data = {};
    data.company = id;
    data.period = $('#indicatorPeriod').val();
    data.user_id = "{{ $userId }}";

    $.ajax({
        url: '/api/indicatorEvaluate',
        type: 'post',
        dataType: 'json',
        data: JSON.stringify(data),
        success: function ( obj ) {
            if( obj.length > 0){
                var i = 0;
                obj.forEach(function (value) {
                    $('#name'+i).text(value.indicator);
                    $('#value'+i).text(value.value);
                    i++;
                });
            }
            if(!prepared) prepareDataTable();
        }
    });
}

</script>
@endsection
