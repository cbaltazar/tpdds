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
                      <div class="ibox-tools">
                          <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                          </a>
                      </div>
                  </div>
                  <div class="ibox-content">

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
                        <label>Periodo:</label>
                          <select id="indicatorPeriod">
                          <!--LEVANTAR LOS AÑOS DISPONIBLES-->
                            @foreach($indicatorsPeriods as $indicatorPeriod)
                              <option value={{$indicatorPeriod->periodo}}>{{$indicatorPeriod->periodo}}</option>
                            @endforeach
                          </select>

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTable" >
                <thead>
                <tr>
                    <th>Indicador</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody id="indicator-values-conteiner"></tbody>
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

function calculateIndicator(){
    $('#indicator-values-conteiner').empty();
    var id = window.location.href.split("/")[4];
    var data = {};
    data.company = id;
    data.period = $('#indicatorPeriod').val();

    $.ajax({
        url: '/api/indicatorEvaluate',
        type: 'post',
        dataType: 'json',
        data: data,
        success: function ( obj ) {
            obj.forEach(function (value) {
                $('#indicator-values-conteiner').append('<tr><td>'+
                    value.indicator +
                    '</td><td>'+
                    value.value +
                    '</td></tr>');
            })
        }
    });
}

$(document).ready(function() {
    $('.dataTable').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "{{asset('js/plugins/dataTables/swf/copy_csv_xls_pdf.swf')}}"
        }
    });
    calculateIndicator();
    $('#indicatorPeriod').change(function(){
        calculateIndicator();
    });
});

</script>
@endsection
