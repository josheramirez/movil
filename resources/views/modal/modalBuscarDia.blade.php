
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
    .card1{
        box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width:150px;
        height:40px;
        margin-bottom:.3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;


    }
    .container-card1 {
        padding: 2px 16px;
    }
    .cajaDatos{
        display:flex;
        justify-content: space-around;

    }
    .titulo{
           display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            font-size:2rem
    }
    .patente{
        margin-bottom:30px;

    }
    .small{
        font-size:80%;
        justify-content: center;
        text-align: center;
    }
</style>

<div id="modalBuscarDia" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><span style="">Viajes </span><span style="padding-left:10px;text-transform: uppercase"><strong>{{$fecha}}</strong></span></h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="contenido_evento">
                <div class="col-md-12 border">
                    <div class="col-md-12" id="solicitudInfo" style="margin-bottom:10px;padding-top:10px">
{{--  {{print_r($columnas)}}  --}}
                        @if (count($viajes)>0)
                            <h5 style=""> </h5>
                            <div class="cajaDatos" style="margin-left:1em">
                                {{--  @foreach ($viajes as $viaje)
                                    <div class="viaje">{{$viaje->hora}}</div>
                                @endforeach  --}}
                                @foreach ($columnas as $columna)
                                    <div class="columna-movil {{$columna->id}}" >
                                        <div class="patente" style="border-radius:.5rem" >
                                            <div class="small">Vehiculo patente</div>
                                            <div class="titulo" >
                                              {{$columna->patente}}
                                            </div>
                                        </div>
                                        @foreach ($horas as $hora)
                                            <div class="card1" style="border-radius:.5rem">
                                                <div class=".container-card1 ">
                                                    <div id="{{str_replace(":00","",$hora)}}" style="color:#fff"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 style="margin:auto">No ahy viajes agendados para hoy.</h5>
                        @endif
                    </div>
                    <div class="col-md-12" style="margin:auto">
                        <hr/>
                    </div>

                    @if (1==1)

                    @else
                        {{-- ACCIONES --}}
                        <div class="col-md-12" style="">

                        </div>
                    @endif

                    {{-- FORMULARIO --}}
                    <div class="cajaFormulario col-md-12" style="margin:auto">
                        <div class="" style="padding-top:15px">

                        </div>
                    </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer btn_modalBuscarProfesional">
                @if(1==1)
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                @endif
            </div>
        </div>
    </div>
</div>


<script>

    // JQUERY
    $(document).ready(function() {

        var viajes = {!! json_encode($viajes->toArray()) !!};
        console.log(viajes)
        for(var k in viajes) {
            if(viajes[k].sentido=="ida"){
                console.log(viajes[k].movil_id,viajes[k].hora);
                $('.'+viajes[k].movil_id).find('#'+viajes[k].hora_salida.replace(":00","")).html(viajes[k].hora_salida).parent().parent().css('background-color','rgb(122, 84, 245)');
            }else{
                console.log(viajes[k].movil_id,viajes[k].hora);
                $('.'+viajes[k].movil_id).find('#'+viajes[k].hora.replace(":00","")).html(viajes[k].hora).parent().parent().css('background-color','rgb(122, 84, 245)');
            }

        }


    });


</script>
