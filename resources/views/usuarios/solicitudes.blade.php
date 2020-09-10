@extends('layouts.master')

@section('content')

<script src="{{ URL::asset('/plugins/datatables/Responsive/js/dataTables2.responsive.min.js') }}"></script>

<input type="text" value="{{session()->get('message') }}" id="valorSesion" hidden>

{{session()->get('message') }}

<div class="col-md-11" style="margin:auto">
<section class="content-header">
    <div class="container-fluid">

    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-left:auto;margin-right:auto">
                <div class="card">
                    <div class="card-header" style="margin-right:0px">
                        <h3 class="card-title" style="margin-top:5px">SOLICITUDES DE VIAJES realizadas por
                        <strong>{{strtoupper (Auth::user()->name)}}</strong></h3>
                    </div>
                    <div class="card-body">
                        {{-- mensajes status --}}
                        <div class="col-md-12" style="padding:0px">
                            @if (session('status')=='nuevos_postulantes')
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Atención!</h5>
                                Has enviado nuevos postulantes a la solicitud!
                            </div>
                            @endif
                        </div>
                        {{-- tabla capacitaciones --}}
                        <table  class="table table-striped table-bordered table-sm nowrap" id="tabla_solicitudesViaje" style="width: 100%" >
                            <thead class="bold">
                                <tr>
                                    <td>Cod.</td>
                                    <td>Destino</td>
                                    <td>Fecha</td>
                                    <td>Hora salida/regreso</td>
                                    <td>Pasajeros</td>
                                    <td>Sentido</td>
                                    <td>Estado</td>
                                    <td>Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitudes as $key => $solicitud)
                                    <tr>
                                        <td style=" text-align: center">{{$solicitud->id}}</td>
                                        <td>{{$solicitud->destino}}</td>
                                        <td>{{$solicitud->fecha_agendada}}</td>
                                        <td>{{$solicitud->hora_salida}}/{{$solicitud->hora_llegada}}</td>
                                        <td>{{$solicitud->pasajeros}}</td>
                                        <td>
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
                                        </td>
                                        <td>
                                            @switch($solicitud->estado()->estado)
                                                @case("pendiente")
                                                    <span style="color:#0073b7;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                    @break
                                                @case("cancelado")
                                                    <span style="color:#f0ad4e;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
                                                    @break
                                                @case("rechazado")
                                                    <span style="color:#bb2124;font-weight:600">{{strtoupper ( $solicitud->estado()->estado)}}</span>
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
                                        </td>
                                        <td style="text-align:center">
                                            <button type="button" class="btn btn-info btn-sm editarSolicitud" name="{{$solicitud->id}}" id="{{$solicitud->id}}" title="edicion solicitud" onclick="editarSolicitud(this.name)" title=""><i class="fas fa-info-circle" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm eliminarSolicitud" name="{{$solicitud->id}}" title="eliminar solicitud" onclick="eliminarSolicitud(this.name)" title=""><i class="fas fa-trash" aria-hidden="true"></i></button>
                                            {{-- <button type="button" class="btn btn-warning btn-sm mostrarCambioEstado" name="{{$solicitud->id}}" onclick="cambioEstado(this.name)" title="Cambio de estado" @if($solicitud->estado_solicitud_id == 4) disabled @endif><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm asignarNotas" name="{{$solicitud->id}}" onclick="asignarNotas(this.name)" title="Asignar nota"><i class="fas fa-graduation-cap" aria-hidden="true"></i></button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal">
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" value="">
        <div class="modal-dialog modal-lg" role="document">
            <input type="hidden" id="id_eliminar" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_evento">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenido_evento">
                    <div class="row">
                        <div class="col-md-6">
                            <table style="width: 100%;">
                                <tbody id="contenido_tabla">
                                    <tr>
                                        <td>Hora Inicio : </td>
                                        <td>10:00</td>
                                    </tr>
                                    <tr>
                                        <td>Hora Termino : </td>
                                        <td>14:30</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="cerrarModal()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- /.content -->

<!-- fullCalendar 2.2.5 -->
<script src="{{ URL::asset('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar/main.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar/locales-all.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
<script src="{{ URL::asset('/plugins/popper/umd/popper.min.js') }}"></script>


<script>
    var options = { now: "8:00", //hh:mm 24 hour format only, defaults to current time
    twentyFour: false, //Display 24 hour format, defaults to false
    upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
    downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
    close: 'wickedpicker__close', //The close class selector to use, for custom CSS
    hoverState: 'hover-state', //The hover state class to use, for custom CSS
    title: 'Timepicker', //The Wickedpicker's title,
    showSeconds: false, //Whether or not to show seconds,
    secondsInterval: 1, //Change interval for seconds, defaults to 1
    minutesInterval: 30, //Change interval for minutes, defaults to 1
    beforeShow: null, //A function to be called before the Wickedpicker is shown
    show: null, //A function to be called when the Wickedpicker is shown
    clearable: false, //Make the picker's input clearable (has clickable "x")
    };

        $('.timepicker').wickedpicker({title: 'Selecciona hora',minutesInterval:15,now: "8:00",twentyFour: true});


        $('.datepicker').datepicker({
            startDate: new Date(),
            format: 'yyyy/mm/dd',
        });

        $('.timepicker').change(function(){

            console.log(this.value);
        });

        $(".timepicker").focus(function(){
            var obj = $(this);

            $('.wickedpicker').each(function(){
                if($(this) != obj) {
                $(this).css({'display': 'none'});
            }
        });
});
</script>

<script>
    $(document).ready(function() {
        $('#tabla_solicitudesViaje').DataTable({
            responsive: true,
            "pageLength": 50,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Buscar:",
                "processing": "Consultando...",
                "paginate": {
                    "first": "Primera",
                    "last": "Ultima",
                    "next": '<i class="fas fa-chevron-right"></i>',
                    "previous": '<i class="fas fa-chevron-left"></i>'
                },
            },
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null, //Added New
                null, //Added New
            ],
        });

        mensaje = @json(session('mensaje'));
        if (mensaje == 'pre-asignados') {
            Swal.fire({
                type: 'success',
                title: 'Profesionales pre-asignados exitosamente!',
                showConfirmButton: false,
                timer: 5000
            });
        }
        if (mensaje == 'asignados') {
            Swal.fire({
                type: 'success',
                title: 'Profesionales asignados exitosamente!',
                showConfirmButton: false,
                timer: 5000
            });
        }
        if (mensaje == 'cambio_estado') {
            Swal.fire({
                type: 'success',
                title: 'Cambio de estado realizado con exito!',
                showConfirmButton: false,
                timer: 5000
            });
        }
        if (mensaje == 'finalizado') {
            Swal.fire({
                type: 'success',
                title: 'Inscripciones finalizadas, cambiando estado del curso ahora a INSCRITO!',
                showConfirmButton: false,
                timer: 5000
            });
        }
        if (mensaje == 'estado_no_permitido') {
            Swal.fire({
                type: 'warning',
                title: 'El curso debe estar en estado DISPONIBLE!',
                showConfirmButton: false,
                timer: 5000
            });
        }

    });

    function editarSolicitud(id) {
        $(".editarSolicitud").attr('disabled', true);
        ruta = @json(route('solicitud.editarSolicitud', ['id' => 'id_prof']));
        ruta = ruta.replace('id_prof', id);
        console.log(ruta);
        $('.modal').modal('hide');
        $.get(ruta, function(data) {
            $('#modal').html(data);
            $('#modalEditarSolicitud').modal('show');
        });
    };

    function eliminarSolicitud(id) {
           Swal.fire({
                title: 'Quieres cancelar este viaje?',
                text: "Esta accion sera permanente !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cancelar!',
                cancelButtonText: 'No, le pensare!'
            }).then((result) => {
                if (result.value) {
                    //Swal.fire(
                    //'Cancelado!',
                    //'Tu viaje a sido cancelado.',
                    //'success'
                    //);
                    console.log("enviando a controlador");
                }
            })
    };
</script>
@endsection