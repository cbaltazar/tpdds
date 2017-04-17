@extends ('master')
@section ('title','Indicadores')
@section ('head')

@endsection
@section ('content')
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listado de Indicadores</h5>
                            <div class="ibox-tools">
                                <a href="" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Crear nuevo Indicador</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!--div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div-->

                            <div class="project-list">

                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Contract with Zender Company</a>
                                            <br/>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">There are many variations of passages</a>
                                            <br/>
                                            <small>Created 11.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-warning">inactivo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Many desktop publishing packages and web</a>
                                            <br/>
                                            <small>Created 10.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Letraset sheets containing</a>
                                            <br/>
                                            <small>Created 22.07.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Contrary to popular belief</a>
                                            <br/>
                                            <small>Created 14.07.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Contract with Zender Company</a>
                                            <br/>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">There are many variations of passages</a>
                                            <br/>
                                            <small>Created 11.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-warning">inactivo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Many desktop publishing packages and web</a>
                                            <br/>
                                            <small>Created 10.08.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Letraset sheets containing</a>
                                            <br/>
                                            <small>Created 22.07.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">activo</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('indicatorDetail') }}">Contrary to popular belief</a>
                                            <br/>
                                            <small>Created 14.07.2014</small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Ver </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Borrar </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
