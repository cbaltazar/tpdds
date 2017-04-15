@extends ('master')
@section ('title','Cuentas')
@section ('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>All projects assigned to this account</h5>
                    <div class="ibox-tools">
                        <a href="" class="btn btn-primary btn-xs">Create new project</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="container">
                        <div class="row">
                            @if( $listado != null)
                                <div class="col-md-3">Empresa</div>
                                <div class="col-md-3">Cuenta</div>
                                <div class="col-md-3">Periodo</div>
                                <div class="col-md-3">Monto</div>
                                @foreach($listado as $empresa )
                                    <div class="col-md-3">{{$empresa->getNombreEmpresa()}}</div>
                                    <div class="col-md-3">{{$empresa->getNombreCuenta()}}</div>
                                    <div class="col-md-3">{{$empresa->getPeriodo()}}</div>
                                    <div class="col-md-3">{{$empresa->getMonto()}}</div>
                                @endforeach
                            @else
                                    No hay cuentas cargadas.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
