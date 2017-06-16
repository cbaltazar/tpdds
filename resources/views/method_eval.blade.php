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
                      <tbody>
                      @for($i=1;$i<=10;$i++)
                      <tr>
                          <td>
                            <div class="icheckbox_square-green" style="position: relative;">
                              <input type="checkbox" checked="" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                            </div>
                          </td>
                          <td>Empresa {{$i}}</td>
                      </tr>
                      @endfor
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
            <td class="project-status">
              <h5 style="font-size:14px">Evaluar mediante:</h5>
            </td>
            <td class="project-title" style="padding:13px 10px">
              <select class="form-control">
                @for($i=1;$i<4;$i++)
                  <option> metodología {{$i}}</option>
                @endfor
              </select>
            </td>
            <td class="project-actions">
              <a href="{{ url('methodDetail') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Ver </a>
              <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Aplicar</a>
            </td>
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
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
       });
    </script>
@endsection
