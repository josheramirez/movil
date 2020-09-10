<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Solicitud extends Model
{
    use SoftDeletes;
    protected $table='solicitudes';

    public function eventsAll($id)
    {
        $events = Solicitud::all();
        return $events;
    }

    public function usuario(){
        return  $this->hasOne('App\User', 'id', 'usuario_agendador_id');
    }

    public function estado(){
        return  $this->hasOne('App\SolicitudEstado', 'id', 'estado')->first();
    }

    public function solicitud_movil(){
        return $this->hasOne('App\SolicitudMovil','solicitud_id','id');
    }


    public function moviles_disponibles(){
        // considero solo las horas de salida
        $dispos=[];
        $dispos_regreso=[];
        $falsos=[];
        $falsos_regreso=[];
        $movil_revisados=[];
        $movil_revisados_regreso=[];
        $solicitudes_revisadas=[];
        $solicitudes_revisadas_regreso=[];
        $movil_agendados_no_disponibles=[];
        $movil_agendados_no_disponibles_regreso=[];

        // traigo todo los moviles asignados a ese dia
        $solicitudes_del_dia=DB::table('solicitudes')->where('solicitudes.fecha_agendada',$this->fecha_agendada)->where('solicitudes.id', '<>',$this->id )
                            ->join('solicitud_estado', 'solicitud_estado.id', '=', 'solicitudes.estado')->where('solicitud_estado.estado',"gestionado")
                            ->join('solicitud_movil','solicitud_movil.solicitud_id','=','solicitudes.id')->get();

        $salida_a=Carbon::createFromTimeString(str_replace(' ', '',$this->hora_salida))->diffInSeconds(Carbon::createFromTimeString("06:00"));
        $regreso_a=Carbon::createFromTimeString(str_replace(' ', '',$this->hora_llegada))->diffInSeconds(Carbon::createFromTimeString("06:00"));

        $hora_finish=Carbon::createFromTimeString(str_replace(' ', '', $this->hora_salida))->addHour(2);

        // todos los moviles
        $moviles_del_dia=$solicitudes_del_dia->pluck('movil_id')->unique();

        // ANALISO SOLO salida solicitus -> otras salida
        foreach ($moviles_del_dia as $key => $movil) {
            $dispo=true;
            array_push($movil_revisados,$movil);
            $solicitudes=$solicitudes_del_dia->where('movil_id', $movil);
            // dd($moviles_del_dia,$solicitudes);

            // $movil=Movil::find($solicitud->movil_id);
            // $solicitudes=$movil->solicitudes();
            foreach ($solicitudes as $key => $solicitud_del_movil) {
                array_push($solicitudes_revisadas,$solicitud_del_movil->solicitud_id);
                $salida_b=Carbon::createFromTimeString(str_replace(' ', '',$solicitud_del_movil->hora_salida))->diffInSeconds(Carbon::createFromTimeString("06:00"));
                // $regreso_b=$Carbon::createFromTimeString(str_replace(' ', '',$solicitud_del_movil->hora_regreso))->diffInSeconds(Carbon\Carbon::createFromTimeString("06:00"));

                // // CALCULO LAS HORAS DE SALIDA
                // // tomo como referencia las 6 de la manana
                // // B-A -> si es positivo B mayor a A (saida despues que la solicitud), si es negativo es menor (sale antes q la solicitud)

                // // sale despues de la salida de la solicitud (movil no tiene salidad destro de las proximas 2 horas)
                if($salida_b-$salida_a>=0){
                    if($salida_b-$salida_a>=7200){
                        //sirve
                    }else{
                       $dispo=false;
                       array_push($falsos,$solicitud_del_movil->solicitud_id);

                    }
                // tiene salida antes de la solicitud
                }else{
                    // la solicitud es de tipo salida o regreso pero el movil solo ve salidas, por eso las salidas movil tipo regreso (solicitud) a la base se considera solo 1 hora
                    //se calcula hora salida mas una hora para llegar a la base
                    if ($salida_b+7200<=$salida_a) {
                        // array_push($disponible_salida,$solicitud->id);
                    } else {
                        $dispo=false;
                        array_push($falsos,$solicitud_del_movil->solicitud_id);
                    }
                }
            }
            if(!$dispo){
                array_push($movil_agendados_no_disponibles,$movil);
            }
            array_push($dispos,$dispo);

        }
        // dd($movil_agendados_no_disponibles);

        // ANALISO salida solicitud con todos los regresos
        if($this->sentido==1){
            // por cada movil reviso sus viajes
            foreach ($moviles_del_dia as $key => $movil) {
                $dispo=true;
                array_push($movil_revisados_regreso,$movil);
                $solicitudes=$solicitudes_del_dia->where('movil_id', $movil);

                foreach ($solicitudes as $key => $solicitud_del_movil) {
                    array_push($solicitudes_revisadas_regreso,$solicitud_del_movil->solicitud_id);
                    $regreso_b=Carbon::createFromTimeString(str_replace(' ', '',$solicitud_del_movil->hora_llegada))->diffInSeconds(Carbon::createFromTimeString("06:00"));
                    if($regreso_b-$salida_a>=0){
                        if($regreso_b-$salida_a>=7200){
                            //sirve
                        }else{
                            $dispo=false;
                            array_push($falsos_regreso,$solicitud_del_movil->solicitud_id);

                        }
                    // tiene salida antes de la solicitud
                    }else{
                        if ($regreso_b+3600<=$salida_a) {
                            // sirve
                        } else {
                            $dispo=false;
                            array_push($falsos_regreso,$solicitud_del_movil->solicitud_id);
                        }
                    }
                }
                if(!$dispo){
                    array_push($movil_agendados_no_disponibles_regreso,$movil);

                }
                array_push($dispos_regreso,$dispo);
            }
            // dd($movil_agendados_no_disponibles_regreso);
        }

        // analiso regreso solicitud con todos otras salidas y regreso
        $movil_revisados_todos=[];
        $solicitudes_revisadas_todas=[];
        $falsos_regreso_todas=[];
        $dispo_todas=true;
        $movil_no_disponibles_todas=[];
        $dispos_todas=[];

        if($this->sentido==1){
            // por cada movil reviso sus viajes
            foreach ($moviles_del_dia as $key => $movil) {
                $dispo=true;
                array_push($movil_revisados_todos,$movil);
                $solicitudes=$solicitudes_del_dia->where('movil_id', $movil);

                foreach ($solicitudes as $key => $solicitud_del_movil) {
                    array_push($solicitudes_revisadas_todas,$solicitud_del_movil->solicitud_id);
                    $regreso_b=Carbon::createFromTimeString(str_replace(' ', '',$solicitud_del_movil->hora_llegada))->diffInSeconds(Carbon::createFromTimeString("06:00"));
                    $salida_b=Carbon::createFromTimeString(str_replace(' ', '',$solicitud_del_movil->hora_salida))->diffInSeconds(Carbon::createFromTimeString("06:00"));


                    // comparo los regresos de una solicitud
                    if($regreso_b-$regreso_a>=0){
                        if($regreso_b-$regreso_a>=7200){
                            //sirve
                        }else{
                            $dispo_todas=false;
                            array_push($falsos_regreso_todas,$solicitud_del_movil->solicitud_id);
                        }
                    }else{
                        if ($regreso_b+3600<=$regreso_a) {
                            // sirve
                        } else {
                            $dispo_todas=false;
                            array_push($falsos_regreso_todas,$solicitud_del_movil->solicitud_id);
                        }
                    }

                    // comparo regreso con todas las salidas
                    if($salida_b-$regreso_a>=0){
                        if($salida_b-$regreso_a>=7200){
                            //sirve
                        }else{
                            $dispo_todas=false;
                            array_push($falsos_regreso_todas,$solicitud_del_movil->solicitud_id);
                            // dd($solicitud_del_movil->solicitud_id);
                        }
                    }else{
                        if ($salida_b+3600<=$regreso_a) {
                            // sirve
                        } else {
                            $dispo_todas=false;
                            array_push($falsos_regreso_todas,$solicitud_del_movil->solicitud_id);
                        }
                    }



                }
                if(!$dispo_todas){
                    array_push($movil_no_disponibles_todas,$movil);
                }
                array_push($dispos_todas,$dispo_todas);
            }
            // dd($solicitudes);
        }

    //  dd($movil_no_disponibles_todas);


        $moviles=Movil::all()->pluck('id')->toArray();
        $moviles_disponibles=array_diff($moviles, $movil_agendados_no_disponibles);
        $moviles_disponibles_regreso=array_diff($moviles, $movil_agendados_no_disponibles_regreso);


        $moviles_disponibles_todas=array_diff($moviles,$movil_no_disponibles_todas);


        $interseccion = array_intersect($moviles_disponibles, $moviles_disponibles_regreso,$moviles_disponibles_todas);



        $moviles_disponibles_salida=array_unique(array_merge($movil_agendados_no_disponibles,$movil_agendados_no_disponibles_regreso));
        $moviles_disponibles_salida=array_diff($moviles, $moviles_disponibles_salida);
        //  dd($moviles_disponibles_salida);
        // dd($movil_agendados_no_disponibles,$movil_agendados_no_disponibles_regreso,$moviles_disponibles,$moviles_disponibles_regreso, $interseccion);
        // $moviles=Movil::whereIn('id',$moviles_disponibles)->get();

        $moviles=Movil::whereIn('id', $interseccion)->get();
        // dd($moviles);

        $moviles_salida=true;
        $moviles_regreso=true;

        if(count($moviles)==0){
            if(count($interseccion)==0) {
                // dd("no hay vehiculos disponibles");
            }
            if(count($moviles_disponibles)==0) {
                // dd("no hay vehiculos disponibles la salida");
                $moviles_salida=false;
            }
            if(count($moviles_disponibles_regreso)==0) {
                // dd("no hay vehiculos disponibles para el regreso");
                $moviles_regreso=false;
            }
        }


        // dd($moviles,$moviles_disponibles_salida, $moviles_disponibles_todas);

        //     $totalDuration =$hora_start->diffInSeconds($hora_salida);
        //     dd($hora_start,$hora_finish, $hora_salida,gmdate('H:i:s', $totalDuration),$hora_salida->diffInSeconds(),$hora_start->diffInSeconds() );

        // return  [$moviles,$moviles_salida,$moviles_regreso];
        return  [$moviles,$moviles_disponibles_salida,$moviles_disponibles_todas];
    }
}


