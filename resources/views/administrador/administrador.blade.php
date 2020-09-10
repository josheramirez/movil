@extends('layouts.master')


@section('content')
    <link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-daygrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-timegrid/main.min.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/plugins/fullcalendar-bootstrap/main.min.css') }}">

    <style>
        input[type='text'] { font-size: 13px; }
        input[type='number'] { font-size: 13px; }

        .fc-content{
            cursor: pointer
        }
        .fc-content{
            display: flex;
            justify-content: space-between;
            font-size: 120%
        }
        .fc-center{
            text-transform: uppercase;
            margin-right: 130px;
        }

    </style>

    <script>
        events={!!json_encode($eventsJson)!!}
        console.log(events);
    </script>

    <div class="col-md-11" style="margin:auto">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="sticky-top mb-3">

                            {{-- EVENTS DRAGGABLE --}}
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
                            </div>

                            {{-- CAJA AGENDAR VIAJE --}}
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nuevo movil</h4>
                                </div>
                                <div class="card-body" >
                                    <form action="{{route('administrador.nuevoMovil')}}" method="post" id="formulario_crearMovil">
                                        @csrf
                                        {{-- NOMBRE CONDUCTOR --}}
                                        <div class="form-row">
                                            <div class="col-md-12 ">
                                                <div class="form-group ">
                                                    <label>Nombre conductor:</label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-id-card" ></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " id="nombre_conductor" name="nombre_conductor" style="font-size: 110%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- PATENTE --}}
                                        <div class="form-row">
                                            <div class="col-md-12 ">
                                                <div class="form-group ">
                                                    <label>Patente vehiculo:</label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-car" ></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " id="patente" name="patente"  style="font-size: 110%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- MARCA --}}
                                        <div class="form-row">
                                            <div class="col-md-12 ">
                                                <div class="form-group ">
                                                    <label>Marca:</label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-car" ></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " id="marca" name="marca"  style="font-size: 110%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- MODELO-CAPACIDAD --}}
                                        <div class="form-row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label>Modelo:</label>
                                                    @php
                                                        $list=['station','city car','taxi']
                                                    @endphp

                                                    <div class="input-group input-group-sm mb-3">
                                                        <select class="form-control" name="modelo_vehiculo" style="margin-right:5px">
                                                            @foreach ($list as $movil)
                                                                <option value="{{$movil}}" >{{strtoupper ($movil)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Capacidad:</label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" min="1" class="form-control" name="capacidad" style="font-size: 110%" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- BOTON --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="form-control btn btn-primary" style="margin-top: 5px">Crear Movil</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar" style="margin:auto"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

            <!-- Modal -->

            <div id="modal">
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

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--  <script src="{{ URL::asset('/plugins/popper/umd/popper.min.js') }}"></script>  --}}
<!-- Page specific script -->


<script>


{{--  console.log(JSON.stringify(events));  --}}

    var calendar = '';
    var modalAbierto=false;
    var peticionClick=false;
    var modal_activo = false;

    $(document).ready(function() {

        function ini_events(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }
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

        // initialize the external events
        // -----------------------------------------------------------------

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
            },
            'themeSystem': 'bootstrap',
            eventRender: function(info) {
                $(info.el).popover({
                    title: "Destino: "+info.event._def.title,
                    content: 'Estado: '+info.event._def.extendedProps.estado.toUpperCase(),
                    placement: "top",
                    trigger: "hover",
                    container: "body"
                });
                // aqui edito el evento
                //console.log($(info.el).find('.fc-time').first().text().includes(":"));
                //console.log($(info.el));

                if(!$(info.el).find('.fc-time').first().text().includes(":")){
                    {{--  console.log($(info.el).find('.fc-time').first().text()+":00");  --}}
                    $(info.el).find('.fc-time').first().text($(info.el).find('.fc-time').first().text()+":00");
                }
                $(info.el).css('height','30px');

            },
            events:events,
            eventClick: function(calEvent, jsEvent, view) {
                    if(modal_activo==false){
                        modal_activo = true;
                        modalAsignar(calEvent.event);
                    }
            },
            eventDragStart: function(calEvent, jsEvent, view) {
                console.log(calEvent);
            },
            hiddenDays: [0,6],
            customButtons: {
                 today: {
                    text: 'Hoy',
                    click: function() {
                                // so something before
                                //toastr.warning("PREV button is going to be executed")
                                // do the original command
                                calendar.today();
                                $('.fc-event-container').css('padding','1px 0px');
                                $('.fc-day-number').css('cursor','pointer');
                                $('.fc-day-number').on("click",function(){modalDia($(this).parent().attr("data-date"))});
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
                                        $('.fc-day-number').css('cursor','pointer');
                                        $('.fc-day-number').on("click",function(){modalDia($(this).parent().attr("data-date"))});


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
                                        $('.fc-day-number').css('cursor','pointer');
                                        $('.fc-day-number').on("click",function(){modalDia($(this).parent().attr("data-date"))});
                                //toastr.success("NEXT button executed")
                    }
                },
                }
        });

        calendar.render();

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

        $('.fc-event-container').css('padding','1px 0px');
        $('.fc-day-number').css('cursor','pointer');
        $('.fc-day-number').on("click",function(){
            if(modal_activo==false){
                modal_activo = true;
                modalDia($(this).parent().attr("data-date"))
            }
        });


    });
    //$('.fc-day-number').on("click",function(){console.log($(this).parent().attr("data-date")});
    function cerrarModalTodos(elemento){

        console.log(elemento);
    }
    function modalDia(dia){
        ruta = @json(route('administrador.buscarDia', ['dia' => 'id_evento']));
        ruta = ruta.replace('id_evento', dia);
        console.log(ruta);
        $('.modal').modal('hide');

        $.get(ruta, function(data) {
            $('#modal').html(data);
            $('#modalBuscarDia').modal('show');
        });
    }

   async function modalAsignar(event){
        let id_viaje=event._def.publicId;
        ruta = @json(route('administrador.buscarMovil', ['id' => 'id_evento']));
        ruta = ruta.replace('id_evento', id_viaje);
        console.log(ruta);
        $('.modal').modal('hide');


        const peticion=await axios.get(ruta);
            $('#modal').html(peticion.data);
            //console.log( $('#modal').html());
            $('#modalBuscarMovil').modal( 'show');

            //$.get(ruta, function(data) {
            //    $('#modal').html(data);
            //    $('#modalBuscarMovil').modal( 'show');
            //    {{--  $('#modalBuscarMovil').modal({ backdrop: 'static' }, 'show');  --}}
            //    console.log("aqui");

            //}).then(d=>{ console.log($(".modal").is(':visible'))});
        };

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

    function borrarEvento() {
        id = document.getElementById('id_eliminar').value;
        var Calendar = FullCalendar.Calendar;
        calendar.removeEvent(id);
        {{--  console.log(id, calendar);  --}}
        $('#exampleModal').modal('hide');

    }

    $("#modal").on("hide.bs.modal", function () {
        console.log('cerrando');
        modal_activo = false;
    });
    //$('.fc-event-container').css('padding','1px 0px');
    //$('.fc-day-number').css('cursor','pointer');
    //$('.fc-day-number').on("click",function(){modalDia($(this).parent().attr("data-date"))});
</script>
@endsection
