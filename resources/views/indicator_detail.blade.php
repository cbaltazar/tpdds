@extends ('master')
@section ('title','Ver Indicador')
@section ('head')
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section ('content')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editor de indicador</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" name="indicator-form" style="margin-top:15px"
                              action="{{ url('indicatorSave') }}/{{ $indicatorObject->id or "" }}">
                            <input type="hidden" name="formulaElements" id="formulaElements" value="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group"><label class="col-sm-2 control-label">Nombre *</label>
                                <div class="col-sm-9"><input type="text" name="name" id="name" class="form-control dis" placeholder="Nombre del indicador" value="{{$indicatorObject->nombre or " "}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-9"><input type="text" name="description" id="description" class="form-control dis" placeholder="Descripción del indicador" value="{{$indicatorObject->descripcion or " "}}">
                                    <span class="help-block m-b-none">Este campo le permitirá dar una breve descripción del indicador generado.</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
                                <div class="checkbox i-checks"><label> <input @if( $indicatorObject != null and $indicatorObject->predefinido) disabled @endif type="checkbox" name="status[]" id="status" value=""
                                        @if($indicatorObject != null and $indicatorObject->activo)
                                                checked
                                        @endif > <i></i>
                                        Activo </label></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group" id="formula-group">
                              <label class="col-sm-2 control-label">Fórmula*</label>
                                <div class="col-sm-6">
                                    <input name="formula" id="formula" type="text" class="form-control dis" placeholder="Fórmula del indicador" value="{{$indicatorObject->formula or " "}}" >
                                    <span class="help-block m-b-none" id="message"></span>
                                </div>
                                <div class="col-sm-3">
                                    <select name="symbols" class="form-control dis" id="symbols" multiple></select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <span class="col-sm-2 col-sm-offset-10 help-block"><i>* Campo obligatorio.</i></span>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-5">
                                    <input type="button" class="btn btn-white" onclick="location.href='{{URL::previous()}}';" value="Cancelar" name="cancel"></input>
                                    <button class="btn btn-primary dis" id="saveIndicator" name="save">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section ('scripts')

    <script src="{{asset('js/plugins/mathjs/math.min.js')}}"></script>
    <script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/form-validations.js')}}"></script>
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        var scope = {};
        var formula = "";
        var indicators = JSON.parse('{!! json_encode($variable) !!}');

        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
          @if( $indicatorObject != null and $indicatorObject->predefinido)
            $(".dis").attr("disabled", true);
          @endif
        });

        for (var i = 0; i < indicators.length && indicators[i].nombre != "{{$indicatorObject->nombre}}"; i++) {
            $("#symbols").append("<option>"+indicators[i].nombre+"</option>");
            indicators[i].nombre = indicators[i].nombre.replace(/\s+/g,'');
            scope[indicators[i].nombre] = 1;
        }
        @if( $indicatorObject == null or !$indicatorObject->predefinido)
        $("#symbols option").dblclick(function() {
            $('#formula').val($('#formula').val()+this.value);
            validateEc();
        });
        @endif

        $('#formula').on('input', function () {
            validateEc();
        });

        function validateEc(){
            try {
                content = $('#formula').val().replace(/\s/g,'');
                $('#formula-group').removeClass('has-error');
                $('#message').empty();
                $('#saveIndicator').removeClass("disabled");
                math.eval(content, scope)
            }
            catch (e) {
                $('#formula-group').addClass('has-error');
                $('#saveIndicator').addClass("disabled");
                $('#message').text(e.message)
            }
        }

        $('#saveIndicator').click( function(){
            $('#formula').val($('#formula').val().trim());
            var node = math.parse($('#formula').val().replace(/\s/g,'_'));
            var filtered = node.filter(function (node) {
                return node.isSymbolNode;
            });

            var idsFiltered = [];
            indicators.forEach(function(value){
                filtered.forEach(function(elem){
                    if( elem.toString().replace("_", "") === value.nombre ){
                        var formulaElement = {};
                        formulaElement.id = value.id;
                        formulaElement.class = value.clase;
                        idsFiltered.push(formulaElement);
                    }
                });
            });
            $('#formulaElements').val(JSON.stringify(idsFiltered));
        });
    </script>
@endsection
