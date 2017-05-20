@extends ('master')
@section ('title','Ver Cuentas')
@section ('head')
<!-- Data Tables Styles -->
<link href="{{asset('css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">
@endsection
@section ('content')
        <div class="wrapper wrapper-content animated fadeInRight">
          <div class="row">
              <div class="col-lg-12">
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
                      <th>Company</th>
                      <th>Period</th>
                      <th>Account</th>
                      <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if( count($accounts) > 0)
                      @foreach($accounts as $account)
                          <tr>
                              <td>{{ $account->nombreEmpresa }}</td>
                              <td>{{ $account->periodo }}</td>
                              <td>{{ $account->nombreCuenta }}</td>
                              <td>{{ $account->monto }}</td>
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
