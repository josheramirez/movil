<style>
    .flex {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;

    }
    .accion{
        width: 160px;
        margin-right: 5px
    }


    .col label{
        font-weight: 400;
        color: #4b4b4b;
        padding-left:0px;
    }

    h5{
        font-weight: 500;
    }
</style>

<div id="modalVerSolicitud" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Viaje Solicitado por:<span style="padding-left:10px;text-transform: uppercase"><strong> {{$solicitud->usuario->name}}</strong></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="contenido_evento">
                <div class="col-md-12 border">
                    <!-- DATOS SOLICITUD -->
                    <div class="row col-md-12" id="solicitudInfo" style="margin-bottom:10px;padding-top:10px">
                        <div class="col-md-8" style="margin-top: 0.5em">
                            <h5 style="">Datos solicitud</h5>
                            <div class="cajaDatos" style="margin-left:1em">

                                <!-- {{--estado solicitud --}} -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Estado solicitud</label>
                                    </div>
                                    <div class="col">
                                        @switch($solicitud->estado()->estado)
                                            @case("pendiente")
                                                <span style="color:#0073b7;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @case("cancelado")
                                                <span style="color:#f0ad4e;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)." por el usuario"}}</span>
                                                @break
                                            @case("rechazado")
                                                <span style="color:#bb2124;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)." por el administrador"}}</span>
                                                @break
                                            @case("gestionado")
                                                <span style="color:#7a54f5;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @case("completado")
                                                <span style="color:#22bb33;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                @break
                                            @default
                                                <span>Sin informacion</span>
                                        @endswitch
                                    </div>
                                </div>
                                <!-- {{-- Solicitud estado --}} -->
                                @if ($solicitud->estado()->estado=="rechazado")
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Motivo rechazo</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->estado()->observacion}}</span>
                                        </div>
                                    </div>
                                @endif
                                @if ($solicitud->estado()->estado=="cancelado")
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Motivo cancelacion</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->estado()->observacion}}</span>
                                        </div>
                                    </div>
                                @endif
                                <!-- {{-- tipo de viaje --}} -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Tipo de Viaje</label>
                                    </div>
                                    <div class="col">
                                        @switch($solicitud->sentido)
                                            @case(1)
                                                <span>Ida y Retorno</span>
                                                @break
                                            @case(0)
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
                                <!-- {{-- origen --}} -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Origen</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->origen}}</span>
                                    </div>
                                </div>
                                <!-- {{-- destino --}} -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Destino</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->destino}}</span>
                                    </div>
                                </div>
                                <!-- horas -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Hora salida</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->hora_salida}}</span>
                                    </div>
                                </div>
                                @if ($solicitud->sentido=="0")
                                @else
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Hora regreso</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->hora_llegada}}</span>
                                        </div>
                                    </div>
                                @endif
                                <!-- kms -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Kms estimados</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                <!-- tiempo viaje -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Tiempo estimado</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                <!-- movil asignado -->
                                @if ($solicitud->estado()->estado=="gestionado")
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Movil asignado</label>
                                        </div>
                                        <div class="col">
                                            <div>marca: {{strtoupper($solicitud->solicitud_movil->movil->marca)}}</div>
                                            <div>patente: {{strtoupper($solicitud->solicitud_movil->movil->patente)}}</div>
                                            <div>conductor: {{strtoupper ($solicitud->solicitud_movil->movil->nombre_conductor)}}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin:auto">
                        <hr/>
                    </div>

                    <!-- ACCIONES USUARIO -->
                    @switch($solicitud->estado()->estado)
                        @case("rechazado")

                            @break
                        @case("cancelado")

                            @break
                        {{-- @case("gestionado")

                            @break --}}
                        @case("completado")

                            @break
                        @default
                             <div class="col-md-12" style="">
                                <div class="col">
                                <h5 style="padding-bottom:10px">Acciones</h5>
                                <div class="flex col-md-11">
                                    @if ($solicitud->estado()->estado=="pendiente")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_asignarMovil">Editar viaje</button>
                                    @endif
                                    @if ($solicitud->estado()->estado=="gestionado")
                                        {{-- <button type="button" class="btn btn-default btn_accion accion" id="btn_cancelarViaje">Cancelar viaje</button> --}}
                                    @endif

                                    <button type="button" class="btn btn-default btn_accion accion" id="btn_cancelarViaje">Cancelar viaje</button>
                                    <!-- <button type="button" class="btn btn-default btn_accion accion" id="btn_rechazarSolicitud">Rechazar Solicitud</button> -->
                                </div>
                            </div>
                    @endswitch
                    {{-- @if ($solicitud->estado()->estado!="rechazado")
                        <div class="col-md-12" style="">
                            <div class="col">
                                <h5 style="padding-bottom:10px">Acciones</h5>
                                <div class="flex col-md-11">
                                    @if ($solicitud->estado()->estado=="pendiente")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_asignarMovil">Editar viaje</button>
                                    @endif
                                    @if ($solicitud->estado()->estado=="gestionado")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_cancelarViaje">Cancelar viaje</button>
                                    @endif
                                    <!-- <button type="button" class="btn btn-default btn_accion accion" id="btn_rechazarSolicitud">Rechazar Solicitud</button> -->
                                </div>
                            </div>
                        </div>
                    @endif --}}


                    {{-- FORMULARIO --}}
                    <div class="cajaFormulario col-md-12" style="margin:auto">
                        <div class="" style="padding-top:15px">
                            <form action="{{route('usuario.editarSolicitud')}}" method="POST" id="formulario_editarSolicitud">
                                @csrf
                                <input type="hidden" name="solicitud_id" value="{{$solicitud->id}}">
                                <input type="hidden" name="modo" id="modo" value="">

                                {{-- DATOS RECHAZAR SOLICITUD --}}
                                <div class="col-md-12 opcion" id="cancelarSolicitud" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Motivo de la cancelacion <span style="color:red">*</span></label>
                                            <textarea class="form-control" type="text" name="cancelarObservacion" id="cancelarObservacion"/>
                                            <div class="" style="">
                                                <small id="errorCancelar" class="text-danger" style="display:none">
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
                    @switch($solicitud->estado()->estado)
                        @case("rechazado")
                            @break
                        @case("cancelado")
                            @break
                        @case("gestionado")
                            <button type="button" class="btn btn-primary" id="btn_guardarCambios" style="cursor:default" disabled>Guardar Cambios</button>
                            @break
                        @default
                    @endswitch
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
        $('#btn_guardarCambios').click(function(e){
            console.log($('#modo').val());
            let error=0;
            switch ($('#modo').val()) {
                case 'asignacion':
                    break;
                case 'edicion':
                    break;
                case 'cancelar':
                    if($('#cancelarObservacion').val()==""){
                        $('#errorCancelar').css('display','block');
                        error=error+1;
                    }
                    break;
                default:
                    break;
            }
            if(error==0 && $('#modo').val()!=""){
                $("#formulario_editarSolicitud").submit();
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

        $('#btn_cancelarViaje').click(function(e){
            $('#btn_guardarCambios').prop('disabled', false);
            $('#modo').val('cancelar');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_cancelarViaje').removeClass("btn-default");
            $('#btn_cancelarViaje').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#cancelarSolicitud').css('display','block');
        })

    });



</script>
