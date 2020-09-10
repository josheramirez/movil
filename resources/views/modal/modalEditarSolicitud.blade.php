
<style>

</style>

<div id="modalEditarSolicitud" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Solicitud ID:<span style="padding-left:10px;text-transform: uppercase"><strong> {{$solicitud->id}}</strong></span></h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="">
                <div class="col-md-12 border">
                    {{-- DATOS SOLICITUD --}}
                    <div class="row col-md-12" id="solicitudInfo" style="margin-bottom:10px;padding-top:10px">
                        <div class="col-md-6" style="margin-top: 0.5em">
                            <h5 style="">Datos solicitud</h5>
                            <div class="cajaDatos" style="margin-left:1em">
                                {{--estado solicitud --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Estado solicitud</label>
                                    </div>
                                    <div class="col">
                                        @switch($solicitud->estado()->estado)
                                            @case("pendiente")
                                                <span style="color:#889929;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @case("rechazado")
                                                <span style="color:#9e2424;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @case("gestionado")
                                                <span style="color:#7a54f5;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @case("completadp")
                                                <span style="color:#29992a;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @default
                                                <span>Sin informacion</span>
                                        @endswitch
                                    </div>
                                </div>
                                {{-- Solicitud estado --}}
                                @if ($solicitud->estado()->estado=="rechazado")
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Motivo rechazo</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->estado()->observacion}}</span>
                                        </div>
                                    </div>
                                @endif
                                {{-- tipo de viaje --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Tipo de Viaje</label>
                                    </div>
                                    <div class="col">
                                        @switch($solicitud->sentido)
                                            @case(1)
                                                <span>Ida y Retorno</span>
                                                @break
                                            @case(2)
                                                <span>Solo Ida</span>
                                                @break
                                            @case(3)
                                                <span>Solo Retorno</span>
                                            @break
                                            @default
                                                <span>Sin informacion</span>
                                        @endswitch
                                    </div>
                                </div>
                                {{-- origen --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Origen</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->origen}}</span>
                                    </div>
                                </div>
                                {{-- destino --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Destino</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->destino}}</span>
                                    </div>
                                </div>
                                {{-- hora salida --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Hora salida</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->hora_salida}}</span>
                                    </div>
                                </div>
                                {{-- hora llegada --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Hora llegada</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->hora_llegada}}</span>
                                    </div>
                                </div>
                                {{-- km --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Kms estimados</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                {{-- Tiempo de viaje --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="">Tiempo estimado</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                {{-- Movil asignado --}}
                                @if ($solicitud->estado()->estado=="gestionado")
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Movil asignado</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud_movil->movil_id}} {{$solicitud_movil->movil->marca}}</span>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin:auto">
                        <hr/>
                    </div>

                    @if ($solicitud->estado()->estado!="rechazado")
                        {{-- ACCIONES --}}
                        <div class="col-md-12" style="">
                            <div class="col">
                                <h5 style="padding-bottom:10px">Acciones</h5>
                                <div class="flex col-md-11">
                                    @if ($solicitud->estado()->estado=="pendiente")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_asignarMovil">Asignar Movil</button>
                                    @endif
                                    @if ($solicitud->estado()->estado=="gestionado")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_editarMovil">Editar Movil</button>
                                    @endif
                                    <button type="button" class="btn btn-default btn_accion accion" id="btn_rechazarSolicitud">Rechazar Solicitud</button>
                                </div>
                            </div>
                        </div>
                    @endif


                    {{-- FORMULARIO --}}
                    <div class="cajaFormulario col-md-12" style="margin:auto">
                        <div class="" style="padding-top:15px">
                            <form action="{{route('administrador.asignarMovil')}}" method="POST" id="formulario_asignarMovil">
                                @csrf
                                <input type="hidden" name="solicitud_id" value="{{$solicitud->id}}">
                                <input type="hidden" name="modo" id="modo" value="">

                                {{-- DATOS ASIGNAR MOVIL --}}
                                <div class="col-md-12 opcion" id="asignarMovil" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Movil Disponible</label>
                                            {{-- {!! Form::select($name, $list, $selected, [$options]) !!} --}}
                                            <select class="form-control" name="asignar_movil_id" style="margin-right:5px " >
                                                @foreach ($moviles as $movil)
                                                    <option value="{{$movil->id}}">{{$movil->id}} {{$movil->marca}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Observacion</label>
                                            <textarea class="form-control" type="text" name="asignarObservacion"/>
                                        </div>
                                    </div>
                                </div>
                                {{-- DATOS EDITAR MOVIL --}}
                                <div class="col-md-12 opcion" id="editarMovil" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Elige el nuevo Movil</label>
                                            {{-- {!! Form::select($name, $list, $selected, [$options]) !!} --}}
                                            <select class="form-control " name="editar_movil_id" style="margin-right:5px " >
                                                @foreach ($moviles as $movil)
                                                    <option value="{{$movil->id}}">{{$movil->id}} {{$movil->marca}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Observacion</label>
                                            <textarea class="form-control" type="text" name="editarObservacion"/>
                                        </div>
                                    </div>
                                </div>
                                {{-- DATOS RECHAZAR SOLICITUD --}}
                                <div class="col-md-12 opcion" id="rechazarSolicitud" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Motivo del rechazo <span style="color:red">*</span></label>
                                            <textarea class="form-control" type="text" name="rechazoObservacion" id="rechazoObservacion"/>
                                            <div class="" style="">
                                                <small id="errorRechazo" class="text-danger" style="display:none">
                                                necesitas agregar un motivo.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer btn_modalBuscarProfesional">
                @if(1==1)
                    {{-- <button type="button" class="btn btn-danger" ">Eliminar Evento</button> --}}
                    <button type="button" class="btn btn-primary" id="btn_enviarAsignarMovil" style="cursor:default" disabled>Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                @endif
            </div>
        </div>
    </div>
</div>


<script>
    // MODALES
    function asignarMovil() {
        console.log("enviarAsignarMovil");

    };

    // JQUERY
    $(document).ready(function() {
        $('#btn_enviarAsignarMovil').click(function(e){
            console.log('valor',$('#rechazoObservacion').val());
            console.log($('#modo').val());

            let error=0;
            switch ($('#modo').val()) {
                case 'asignacion':
                    break;
                case 'edicion':
                    break;
                case 'rechazar':
                    if($('#rechazoObservacion').val()==""){
                        $('#errorRechazo').css('display','block');
                        error=error+1;
                    }
                    break;
                default:
                    break;
            }
            if(error==0 && $('#modo').val()!=""){
                $("#formulario_asignarMovil").submit();
            }
        });

        // $('#mydiv').toggleClass('class1 class2');

        $('#btn_asignarMovil').click(function(e){
            $('#btn_enviarAsignarMovil').prop('disabled', false);
            $('#modo').val('asignar');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_asignarMovil').removeClass("btn-default");
            $('#btn_asignarMovil').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#asignarMovil').css('display','block');
        });

        $('#btn_editarMovil').click(function(e){
            $('#btn_enviarAsignarMovil').prop('disabled', false);
            $('#modo').val('editar');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_editarMovil').removeClass("btn-default");
            $('#btn_editarMovil').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#editarMovil').css("display","block");
            // if($('#modo_edicion').val()==0){
            //     $('#editarMovil').css("display","block");
            //     // $('#solicitudInfo').css("padding-bottom","");
            // }else{
            //     $('#aditarMovil').css("display","none");
            //     // $('#solicitudInfo').css("padding-bottom","15px");
            // }
            // $('#modo_edicion').val(1-$('#modo_edicion').val());
        });

        $('#btn_rechazarSolicitud').click(function(e){
            $('#btn_enviarAsignarMovil').prop('disabled', false);
            $('#modo').val('rechazar');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_rechazarSolicitud').removeClass("btn-default");
            $('#btn_rechazarSolicitud').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#rechazarSolicitud').css('display','block');
        })

    });



</script>
