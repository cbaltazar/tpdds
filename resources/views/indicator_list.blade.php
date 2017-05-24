@extends ('master')
@section ('title','Indicadores')
@section ('content')
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listado de Indicadores</h5>
                            <div class="ibox-tools">
                                <a href="{{ url('indicatorDetail') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Crear Indicador</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
                                    @if( count($indicators) > 0)
                                        @foreach($indicators as $indicator)
                                            <tr>
                                                <td class="project-status">
                                                    <span class="label @if( $indicator->activo == 1) label-primary @else label-warning @endif">
                                                         @if( $indicator->activo == 1) Activo @else Inactivo @endif
                                                    </span>
                                                </td>
                                                <td class="project-title">
                                                    <a href="{{ url('indicatorDetail') }}">{{ $indicator->nombre }}</a>
                                                    <br/>
                                                    <small>{{ $indicator->created_at }}</small>
                                                </td>
                                                <td class="project-actions">
                                                    <a href="{{ url('indicatorDetail/'.$indicator->id) }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                                    <a href="{{ url('indicatorDetail/'.$indicator->id) }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>No se encontraron indicadores cargados</p>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
