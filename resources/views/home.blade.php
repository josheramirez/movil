@extends('layouts.master')


@section('content')
<link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar/main.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-daygrid/main.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-timegrid/main.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-bootstrap/main.min.css') }}">


<!-- Content Header (Page header) -->

<style>

input[type='text'] { font-size: 13px; }
input[type='number'] { font-size: 13px; }

.fc-content{
    display: flex;
    justify-content: space-between;
    font-size: 120%
}
.fc-center{
    text-transform: uppercase;
    margin-right: 130px;
}
.fc-content{
    cursor: pointer
}
</style>

{{-- <input type="text" value="{{ json_encode($events)}}" id="eventos" hidden> --}}
<input type="text" value="{{session()->get('message') }}" id="valorSesion" hidden>

{{session()->get('message') }}
    <script>
        events={!!json_encode($eventsJson)!!}
        console.log(events);
    </script>
{{-- {{ Auth::user()}} --}}
<div class="col-md-11" style="margin:auto">
<section class="content-header">
    <div class="container-fluid">
        {{-- <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Calendar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
        </div> --}}
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sticky-top mb-3">
                    <div class="card" style="display:none">
                        <div class="card-header">
                            <h4 class="card-title">Draggable Events</h4>
                        </div>
                        <div class="card-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div class="external-event bg-success">Lunch</div>
                                <div class="external-event bg-warning">Go home</div>
                                <div class="external-event bg-info">Do homework</div>
                                <div class="external-event bg-primary">Work on UI design</div>
                                <div class="external-event bg-danger">Sleep tight</div>
                                <div class="checkbox">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        remove after drop
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Event</h3>
                        </div>
                        <div class="card-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                <div class="input-group-append">
                                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div> --}}

                    {{-- CAJA AGENDAR VIAJE --}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Agendar nuevo viaje</h4>
                            {{-- <h3 class="card-title" style="font-size: 14px ">Agendar viaje</h3> --}}
                        </div>
                        <div class="card-body" >
                            <form action="{{route('solicitud.store')}}" method="post" id="formularioCrearSolicitud">
                                @csrf
                                {{-- DESTINO --}}
                                <div class="form-row">
                                    <div class="col-md-12 ">
                                        <div class="form-group" style="margin-bottom:0px">
                                            <label>Destino:</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-globe-americas" ></i></span>
                                                </div>
                                                <input type="text" class="form-control " id="viaje_destino" name="viaje_destino">
                                            </div>
                                            <div class="" style="height:1.5em">
                                                <small id="errorDestino" class="text-danger validacion"  style="visibility: hidden">
                                                    Debes ingresar un destino.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PASAJEROS, IDA_VUELTA --}}
                                <div class="form-row" >
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-bottom:0px">
                                            <label>Pasajeros:</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                </div>
                                                <input type="number" class="form-control " id="vieje_pasajeros" value="1" name="viaje_pasajeros" min="1">
                                            </div>

                                            <div class="" style="height:1.5em">
                                                <small id="errorPasajero" class="text-danger validacion"  style="visibility: hidden">
                                                    Debes ingresar un destino.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-6" style="text-align: left">
                                        <label> Ida y regreso:</label>
                                        <div class="form-group" style="margin-bottom:0px">
                                            <div class="icheck-primary d-inline" style="margin-right:5%">
                                                <input type="radio" id="sentido_ida" name="viaje_sentido" value="1" checked >
                                                <label for="sentido_ida">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline" style="margin-right:5%">
                                                <input type="radio" id="sentido_regreso" name="viaje_sentido" value="0">
                                                <label for="sentido_regreso">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- FECHAS --}}
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom:0px">
                                            <label>Fecha salida:</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="viaje_fecha_salida" id="viaje_fecha_salida" readonly style="background-color: white" >
                                            </div>
                                            <div class="" style="height:1.5em">
                                                <small id="errorFechaSalida" class="text-danger validacion" style="visibility: hidden">
                                                    Ingrese fecha.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- text input -->
                                        <div class="form-group" style="margin-bottom:0px">
                                            <label>Hora salida:</label>
                                            <div class="input-group input-group-sm ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <input type="text" class="form-control timepicker" name="viaje_hora_salida" id="viaje_hora_salida">
                                            </div>
                                            <div class="" style="height:1.5em">
                                                <small id="errorHoraSalida" class="text-danger validacion" style="visibility: hidden">
                                                    Error fecha llegada.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group" style="margin-bottom:0px">
                                            <label>Hora regreso:</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                    <input type="text" class="form-control timepicker" name="viaje_hora_regreso" id="viaje_hora_regreso">
                                            </div>
                                            <div class="" style="height:1.5em">
                                                <small id="errorHoraRegreso" class="text-danger"  style="visibility: hidden">
                                                    Error fecha salida.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- BOTON --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="form-control btn btn-primary" id="btn_agendar" style="margin-top: 5px">Agendar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{-- CAJA HISTORIAL DE VIAJES --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mis ultimos viajes</h3>
                        </div>
                        <div class="card-body">
                            @foreach($eventsUser as $event)
                            {{-- {{$event}} --}}
                            <div class=" border-bottom row">
                                <div class="col-sm-4 border-right-lg border-right-md-0">
                                  <div class="d-flex justify-content-center align-items-center">
                                    <h1 class="mb-0 mr-2 text-primary font-weight-normal">{{$event->day}}</h1>
                                      <div>
                                        <p class="font-weight-bold mb-0 text-dark">{{ucfirst($event->month)}}</p>
                                        <p class="mb-0">{{$event->year}}</p>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-sm-8 pl-3">
                                    <p class="text-dark font-weight-bold mb-0">Lorem ipsum </p>

                                    @php
                                    // $fecha_salida=str_replace(' ', '',$event->hora_salida);
                                    // $fecha_salida_aux=substr($fecha_salida,-2);
                                    // $fecha_salida=substr($fecha_salida, 0, -2);
                                    // $fecha_salida=$fecha_salida.' '. $fecha_salida_aux;

                                    // $fecha_llegada=str_replace(' ', '',$event->hora_llegada);
                                    // $fecha_llegada_aux=substr($fecha_llegada,-2);
                                    // $fecha_llegada=substr($fecha_llegada, 0, -2);
                                    // $fecha_llegada=$fecha_llegada.' '. $fecha_llegada_aux;
                                    @endphp


                                    <p class="mb-0">{{$event->salida}} - {{$event->llegada}}</p>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar" style="margin: auto;"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <!-- Button trigger modal -->


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
    var calendar = '';
    var modal_activo = false;
    $(document).ready(function() {

        // funcion maneja los dragabbles
        function ini_events(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }
                // console.log("evento "+JSON.stringify(eventObject))
                $(this).data('eventObject', eventObject)

                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                })
            })
        }

        ini_events($('#external-events div.external-event'))

        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendarInteraction.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                console.log()
                events = calendar.getEvents();

                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });
        calendar = new Calendar(calendarEl, {
            locale: 'es',
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
                // right:false
            },
            'themeSystem': 'bootstrap',
            eventRender: function(info) {
                $(info.el).popover({
                    title: "Destino: "+info.event._def.title,
                    content: '',
                    placement: "top",
                    trigger: "hover",
                    container: "body"
                });
                // aqui edito el evento
                console.log($(info.el).find('.fc-time').first().text().includes(":"));

                if(!$(info.el).find('.fc-time').first().text().includes(":")){
                    console.log($(info.el).find('.fc-time').first().text()+":00");
                    $(info.el).find('.fc-time').first().text($(info.el).find('.fc-time').first().text()+":00");
                }
                $(info.el).css('height','30px');
            },
            events:events,
            // events: [{
            //         id: '222222',
            //         title: 'Móvil 1 : de 10:00 a 14:00',
            //         start: '2020-08-12T10:30:00',
            //         end: '2020-08-12T10:30:00',
            //         backgroundColor: '#f56954', //red1
            //         borderColor: '#f56954', //red
            //         allDay: false,
            //         custom: 'shaskjhdsakj'
            //     },
            //     {
            //         id: '12312',
            //         title: 'Long Event',
            //         start: new Date(y, m, d - 5),
            //         end: new Date(y, m, d - 2),
            //         backgroundColor: '#f39c12', //yellow
            //         borderColor: '#f39c12', //yellow
            //         allDay: false
            //     },
            //     {
            //         id: '57434',
            //         title: 'Meeting',
            //         start: new Date('2020/08/01 10:00'),
            //         end: new Date('2020/08/01 14:00'),
            //         allDay: false,
            //         backgroundColor: '#0073b7', //Blue
            //         borderColor: '#0073b7' //Blue
            //     },
            //     {
            //         id: '88634',
            //         title: 'Lunch',
            //         start: new Date(y, m, d, 12, 40),
            //         end: new Date(y, m, d, 14, 20),
            //         allDay: false,
            //         backgroundColor: '#00c0ef', //Info (aqua)
            //         borderColor: '#00c0ef' //Info (aqua)
            //     },
            //     {
            //         id: '55667',
            //         title: 'Birthday Party',
            //         start: new Date(y, m, d + 1, 19, 0),
            //         end: new Date(y, m, d + 1, 22, 30),
            //         allDay: false,
            //         backgroundColor: '#00a65a', //Success (green)
            //         borderColor: '#00a65a' //Success (green)
            //     }
            // ],
            hiddenDays: [0,6 ],
            eventClick: function(calEvent, jsEvent, view) {
                {{-- modalVer(calEvent.event._def.publicId); --}}
                if(modal_activo==false){
                    modal_activo = true;
                    modalVer(calEvent.event._def.publicId);
                }
            },
            eventDragStart: function(calEvent, jsEvent, view) {
                console.log(calEvent);
            },
            customButtons: {
                today: {
                    text: 'Hoy',
                    click: function() {
                                // so something before
                                //toastr.warning("PREV button is going to be executed")
                                // do the original command
                                calendar.today();
                                $('.fc-event-container').css('padding','1px 0px');
                    }
                },
                prev: {
                    //text: 'Prev',
                    click: function() {
                                // so something before
                                //toastr.warning("PREV button is going to be executed")
                                // do the original command
                                calendar.prev();
                                        $('.fc-event-container').css('padding','1px 0px');
                                //toastr.warning("PREV button executed")
                    }
                },
                next: {
                    //text: 'Next',
                    click: function() {
                                // so something before
                                //toastr.success("NEXT button is going to be executed")
                                // do the original command
                                calendar.next();
                                $('.fc-event-container').css('padding','1px 0px');
                                //toastr.success("NEXT button executed")
                    }
                },
            }
        });
        // altura
        // calendar.setOption('height', 800);

        calendar.render();
        // $('#calendar').fullCalendar()
        calend = calendar;

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')

        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        $('#add-new-event').click(function(e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            ini_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
        $('#btn_agendar').click(function(e){
            e.preventDefault();
            $('.validacion').css('visibility','hidden')
            let error=0;

            if($('#viaje_destino').val()==""){
                error++;
                $('#errorDestino').css('visibility','visible');
            }
            if($('#viaje_fecha_salida').val()==""){
                error++;
                $('#errorFechaSalida').css('visibility','visible');
            }
            if($('#viaje_hora_salida').val()==""){
                error++;
                $('#errorHoraSalida').css('display','block');
            }
            if($('#viaje_hora_regreso').val()==""){
                error++;
                $('#errorHoraRegreso').css('display','block');
            }


            if(error==0){
                $("#formularioCrearSolicitud").submit();
            }

        })

        function modalVer(id_viaje){
            ruta = @json(route('home.buscarViaje', ['id' => 'id_evento']));
            ruta = ruta.replace('id_evento', id_viaje);
            console.log("aprete",ruta);
            $('.modal').modal('hide');
            $.get(ruta, function(data) {
                $('#modal').html(data);
                $('#modalVerSolicitud').modal('show');
            });
        };

        $('.fc-event-container').css('padding','1px 0px');
    });

    function getDateTime(date) {
        var now = new Date(date);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours() + 4;
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            month = '0' + month;
        }
        if (day.toString().length == 1) {
            day = '0' + day;
        }
        if (hour.toString().length == 1) {
            hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            second = '0' + second;
        }
        var dateTime = day + '/' + month + '/' + year + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }

    function parseEvents(events) {
        eventos = [];
        //itera sobre los eventos del calendario
        events.forEach(function(valor, indice, array) {
            //Obtengo fecha de inicio y termino
            start = new Date(valor['_instance'].range.start);
            end = new Date(valor['_instance'].range.end);
            //construye y agrega elemento al objeto eventos
            eventos.push({
                id: valor['_def'].publicId,
                title: valor['_def'].title,
                start: getDateTime(start),
                end: getDateTime(end),
                backgroundColor: valor['_def'].ui.backgroundColor,
                borderColor: valor['_def'].ui.borderColor
            });
        });
        return eventos;
    }

    function cerrarModal() {
        // id = document.getElementById('id_eliminar').value;
        // var Calendar = FullCalendar.Calendar;
        // calendar.removeEvent(id);
        // console.log(id, calendar);
        $('#exampleModal').modal('hide');

    }
    $("#modal").on("hide.bs.modal", function () {
        console.log('cerrando');
        modal_activo = false;
    });
</script>
@endsection
