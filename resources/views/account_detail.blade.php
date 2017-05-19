@extends ('master')
@section ('title', Request::segment(2))
@section ('head')
<!-- Data Tables Styles -->
<link href="{{asset('css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">
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
                          <a class="close-link">
                              <i class="fa fa-times"></i>
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
                          <select>
                          <!--LEVANTAR LOS AÑOS DISPONIBLES-->
                            @for($i = 2005; $i < 2018; $i++)
                              <option value={{$i}}>{{$i}}</option>
                            @endfor
                          </select>

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
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
                <tbody>
                  <!--LEVANTAR LOS INDICADORES-->
                  @for($i = 0; $i < 10; $i++)
                    <tr>
                      <td>ROI</td>
                      <td>6.37%</td>
                    </tr>
                  @endfor
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
<!-- Data Tables -->
<script src="{{asset('js/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.dataTable').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "{{asset('js/plugins/dataTables/swf/copy_csv_xls_pdf.swf')}}"
            }
        });
    });
</script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
@endsection
