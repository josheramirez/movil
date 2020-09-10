
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

@php
date_default_timezone_set("America/Santiago");
$hora_actual = date("Y-m-d H:i:s");
@endphp


<div id="modalBuscarMovil" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    {{-- DATOS SOLICITUD --}}
                    {{-- <div class="row col-md-12" id="solicitudInfo" style="margin:auto;padding-top:10px {{$solicitud->estado=="gestionado"?';padding-bottom:15px':''}}""> --}}
                    <div class="row col-md-12" id="solicitudInfo" style="margin-bottom:10px;padding-top:10px">
                        <div class="col-md-8" style="margin-top: 0.5em">
                            <h5 style="">Datos solicitud</h5>
                            <div class="cajaDatos" style="margin-left:1em">
                                {{--estado solicitud --}}
                                <div class="row">
                                    <div class="col-md-4">
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
                                {{-- motivo solicitud--}}
                                @if ($solicitud->estado()->estado=="rechazado")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Motivo rechazo</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->estado()->observacion}}</span>
                                        </div>
                                    </div>
                                @endif
                                 {{-- motivo solicitud--}}
                                @if ($solicitud->estado()->estado=="cancelado")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Motivo cancelacion</label>
                                        </div>
                                        <div class="col">
                                            <span>{{$solicitud->estado()->observacion}}</span>
                                        </div>
                                    </div>
                                @endif
                                {{-- tipo de viaje --}}
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label for="">Origen</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->origen}}</span>
                                    </div>
                                </div>
                                {{-- destino --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Destino</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->destino}}</span>
                                    </div>
                                </div>
                                {{-- hora salida --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Hora salida</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->hora_salida}}</span>
                                    </div>
                                </div>
                                {{-- hora llegada --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Hora llegada</label>
                                    </div>
                                    <div class="col">
                                        <span>{{$solicitud->hora_llegada}}</span>
                                    </div>
                                </div>
                                {{-- km --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Kms estimados</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                {{-- Tiempo de viaje --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Tiempo estimado</label>
                                    </div>
                                    <div class="col">
                                        <span>Sin informacion</span>
                                    </div>
                                </div>
                                {{-- Movil asignado --}}
                                @if ($solicitud->estado()->estado=="gestionado")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Movil asignado</label>
                                        </div>
                                        <div class="col">
                                        @if (isset($solicitud_movil->movil_id))
                                            <span>{{$solicitud_movil->movil_id}} {{$solicitud_movil->movil->marca}}</span>
                                        @endif
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

                    {{-- BOTONES ACCIONES --}}
                    @if ($solicitud->estado()->estado=="rechazado"||$solicitud->estado()->estado=="cancelado"||$solicitud->estado()->estado=="completado")
                    @else
                        <div class="col-md-12" style="">
                            <div class="col">
                                <h5 style="padding-bottom:10px">Acciones</h5>
                                <div class="flex col-md-11">

                                    {{-- botones estado pendiente --}}
                                    @if ($solicitud->estado()->estado=="pendiente")
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_asignarMovil">Asignar Movil</button>
                                    @endif

                                    {{-- botones estado gestionado --}}
                                    @if ($solicitud->estado()->estado=="gestionado")
                                        {{-- <button type="button" class="btn btn-default btn_accion accion" id="btn_editarMovil">Editar Movil</button> --}}

                                        {{-- solo si la fecha agendada es menor o igual a hoy, se ve el boton completar --}}
                                        @if($solicitud->fecha_agendada<=explode(" ", $hora_actual)[0])
                                            {{-- si es ida y vuelta --}}
                                            @if ($solicitud->sentido==1)
                                                {{-- la hora de regreso debe ser menor a la hora actual  --}}
                                                @if ($solicitud->hora_llegada<=$hora_actual)
                                            @else
                                            {{-- si es solo ida, la hora de salida + 1 hora debe ser menor a la hora actual --}}
                                                @if ($solicitud->hora_salida<=date("Y-m-d H:i:s",strtotime('+1 hours', strtotime($hora_actual))))
                                                    <button type="button" class="btn btn-default btn_accion accion" id="btn_completarSolicitud">Completar viaje</button>
                                                @endif
                                            @endif
                                        @endif
                                        <button type="button" class="btn btn-default btn_accion accion" id="btn_completarSolicitud">Completar viaje</button>
                                        @endif
                                        {{-- si es solo de ida --}}
                                        {{-- <button type="button" class="btn btn-default btn_accion accion" id="btn_cancelarSolicitud">Cancelar viaje</button> --}}
                                    @endif
                                    <button type="button" class="btn btn-default btn_accion accion" id="btn_rechazarSolicitud">Rechazar viaje</button>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- FORMULARIO --}}
                    <div class="cajaFormulario col-md-12" style="margin:auto">
                        <input type="hidden" id="cantidad_salida" value="">
                        <div class="" style="padding-top:15px">
                            <form action="{{route('administrador.asignarMovil')}}" method="POST" id="formulario_asignarMovil">
                                @csrf
                                <input type="hidden" name="solicitud_id" value="{{$solicitud->id}}">
                                <input type="hidden" name="modo" id="modo" value="">



                                {{-- DATOS ASIGNAR MOVIL --}}
                                <div class="col-md-12 opcion" id="asignarMovil" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            {{-- no hay moviles q puedan atender junto la ida y regreso --}}
                                            @if (count($moviles)==0)
                                                {{-- no hay movil disponible --}}
                                                @if (count($moviles_salida)==0 && count($moviles_regreso)==0)
                                                    <h5 style="color:red">No hay moviles disponibles</h5>
                                                @endif
                                                {{-- solo se puede atender la salida --}}
                                                @if (count($moviles_regreso)==0 && count($moviles_salida)!=0)
                                                    <div class="ida form-group">
                                                        <label for="">Movil ida :</label>
                                                        <select class="form-control" name="asignar_movil_id" style="margin-right:5px " >
                                                            @foreach ($moviles_salida as $movil)
                                                                <option value="{{$movil}}">{{($movil)}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="regreso ">
                                                        <label for="">Movil regreso :</label>
                                                        <h5 style="color:red">No hay moviles disponibles para el viaje de regreso</h5>
                                                    </div>
                                                @endif
                                                {{-- solo se puede atender el regreso --}}
                                                @if (count($moviles_salida)==0 && count($moviles_regreso)!=0)
                                                    <div class="ida form-group">
                                                        <label for="">Movil ida :</label>
                                                        <h5 style="color:red">No hay moviles disponibles para el viaje de ida</h5>
                                                    </div>
                                                    <div class="regreso ">
                                                        <label for="">Movil regreso :</label>
                                                        <select class="form-control" name="asignar_movil_id" style="margin-right:5px " >
                                                            @foreach ($moviles_regreso as $movil)
                                                                <option value="{{$movil}}">{{($movil)}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                                {{-- se pueden atender la solicitud --}}
                                                @if (count($moviles_salida)!=0 && count($moviles_regreso)!=0)
                                                    <div class="ida form-group">
                                                        <label for="">Movil ida :</label>
                                                        <select class="form-control" name="asignar_movil_id_ida" style="margin-right:5px " >
                                                            @foreach ($moviles_salida as $movil)
                                                                <option value="{{$movil}}">{{($movil)}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="regreso ">
                                                        <label for="">Movil regreso :</label>
                                                        <select class="form-control" name="asignar_movil_id_regreso" style="margin-right:5px " >
                                                            @foreach ($moviles_regreso as $movil)
                                                                <option value="{{$movil}}">{{($movil)}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            {{-- un mismo movil atenderea la ida y la vuelta --}}
                                            @else
                                                <label for="nombre">Movil Disponible</label>
                                                <select class="form-control" name="asignar_movil_id" style="margin-right:5px " >
                                                    @foreach ($moviles as $movil)
                                                        <option value="{{$movil->id}}">{{($movil->id)}} Conductor: {{strtoupper($movil->nombre_conductor)}}; Patente: {{strtoupper($movil->patente)}}; Marca: {{strtoupper($movil->marca)}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Observacion :</label>
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
                                {{-- COMPLETAR SOLICITUD --}}
                                <div class="col-md-12 opcion" id="completarSolicitud" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Observacion <span style="color:red"></span></label>
                                            <textarea class="form-control" type="text" name="completarObservacion" id="completarObservacion"/>
                                        </div>
                                    </div>
                                </div>
                                {{-- CANCELAR SOLICITUD --}}
                                {{-- <div class="col-md-12 opcion" id="cancelarSolicitud" style="padding:0px 15px 0px 15px;display:none">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="nombre">Motivo de la cancelacion <span style="color:red">*</span></label>
                                            <textarea class="form-control" type="text" name="cancelarObservacion" id="cancelarObservacion"/>
                                        </div>
                                        <div class="" style="">
                                            <small id="errorCancelar" class="text-danger" style="display:none">
                                            necesitas agregar un motivo.
                                            </small>
                                        </div>
                                    </div>
                                </div> --}}
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

        var movil_salida={!! json_encode($moviles_salida) !!};
        var movil_regreso={!! json_encode($moviles_regreso) !!};

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
                case 'completar':
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
            if (movil_salida.length==0 || movil_regreso.length==0) {
                $('#btn_enviarAsignarMovil').prop('disabled', true);
            }else{
                $('#btn_enviarAsignarMovil').prop('disabled', false);
            }
            // $('#btn_enviarAsignarMovil').prop('disabled', false);
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
        });

        $('#btn_completarSolicitud').click(function(e){
            $('#btn_enviarAsignarMovil').prop('disabled', false);
            $('#modo').val('completar');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_completarSolicitud').removeClass("btn-default");
            $('#btn_completarSolicitud').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#completarSolicitud').css('display','block');
        });

        $('#btn_cancelarSolicitud').click(function(e){
            $('#btn_enviarAsignarMovil').prop('disabled', false);
            $('#modo').val('cancelarAdministrador');
            $('.btn_accion').removeClass("btn-primary");
            $('.btn_accion').addClass("btn-default");
            $('#btn_cancelarSolicitud').removeClass("btn-default");
            $('#btn_cancelarSolicitud').addClass("btn-primary");
            $('.opcion').css('display','none');
            $('#cancelarSolicitud').css('display','block');
        });


    });
 {{--  console.log($(".modal").is(':visible'));  --}}
</script>
