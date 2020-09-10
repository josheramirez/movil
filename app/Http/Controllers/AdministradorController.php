<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Movil;
use App\SolicitudMovil;
use App\SolicitudEstado;
use Carbon\Carbon;


class AdministradorController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('rol:2;1');
    }

    // pasa todos las solicitudes a la vista
    public function index()
    {
          $eventsAll=Solicitud::all();
          if(!$eventsAll->isEmpty()){
            foreach ($eventsAll as $evento) {
                $hora_salida=str_replace(' ', '', $evento->hora_salida);
                $hora_llegada= str_replace(' ', '', $evento->hora_llegada);

                $hA=Carbon::createFromFormat('Y-m-d H:i', $evento->fecha_agendada.' '.$hora_salida)->toDateTimeString();
                $hB=Carbon::createFromFormat('Y-m-d H:i', $evento->fecha_agendada.' '.$hora_llegada)->toDateTimeString();

                switch ($evento->estado()->estado) {
                    case 'cancelado':
                            $estadoColor='#f0ad4e';
                            // $estadoColor='#889929';
                        break;
                    case 'gestionado':
                            $estadoColor='#7a54f5'; // AZUL BKN
                            // $estadoColor='#7a54f5'; //  MORADO BKN
                        break;
                    case 'completado':
                            $estadoColor= '#22bb33';// VERDE BKN
                            // $estadoColor='#29992a';
                        break;
                    case 'rechazado':
                            $estadoColor='#bb2124';
                            // $estadoColor='#9e2424';
                        break;
                    case 'pendiente':
                            $estadoColor='#0073b7';
                        break;
                    default:
                            $estadoColor='#0073b7';
                        break;
                }

                $eventsJson[]       = [
                    'user_id'         => $evento->usuario_agendador_id,
                    'estado'         => $evento->estado()->estado,
                    'id'         => $evento->id,
                    'title'      => $evento->destino."-".$evento->id,
                    'start'      => $hA,
                    'end'        => $hB,
                    'backgroundColor'=>$estadoColor,
                    'borderColor'=> $estadoColor,
                    'allDay'=> false,
                ];
            }
        }else{
            $eventsAll=null;
            $eventsJson=null;
        }
        return view('administrador.administrador')->with('eventsAll',$eventsAll)->with('eventsJson',$eventsJson);
    }

    // pasa solicitud y moviles disponibles al modal asignarMovil
    public function buscarMovil($id_viaje){
        // dd($id_viaje);
        $solicitud=Solicitud::find($id_viaje);
        $estado_solicitud=$solicitud->estado()->estado;
        $moviles=[];
        $moviles_salida=[];
        $moviles_regreso=[];
        $buscar_movil=true;

        if($estado_solicitud=="completado"||$estado_solicitud=="rechazado"||$estado_solicitud=="cancelado"){
            $buscar_movil=false;
        }

        if ($buscar_movil){
            // dd("calculando moviles disponibles");
            $moviles_datos=$solicitud->moviles_disponibles();
            //  dd($moviles_datos);
            $moviles=$moviles_datos[0];
            $moviles_salida=$moviles_datos[1];
            $moviles_regreso=$moviles_datos[2];
        }

        //    var_dump($id_viaje,$solicitud->estado()->estado,$moviles->pluck('id'));

        // dd($id_viaje,$solicitud);
        if($solicitud->estado()->estado=="gestionado"){
            $solicitud_movil=SolicitudMovil::where('solicitud_id',$solicitud->id)->first();
            // dd($solicitud_movil);
            return view('modal/modalBuscarMovil')
            ->with('moviles', $moviles)
            ->with('solicitud',$solicitud)
            ->with('solicitud_movil',$solicitud_movil)
            ->with('moviles_salida',$moviles_salida)
            ->with('moviles_regreso',$moviles_regreso);
        }

        if($solicitud->estado()->estado=="pendiente"){
            // dd( $moviles_salida,$moviles_regreso);
            return view('modal/modalBuscarMovil')
                ->with('moviles', $moviles)
                ->with('solicitud',$solicitud)
                ->with('moviles_salida',$moviles_salida)
                ->with('moviles_regreso',$moviles_regreso);
        }

        if($solicitud->estado()->estado=="rechazado"){
            return view('modal/modalBuscarMovil')
                ->with('moviles', $moviles)
                ->with('solicitud',$solicitud)
                ->with('moviles_salida',$moviles_salida)
                ->with('moviles_regreso',$moviles_regreso);
        }

        if($solicitud->estado()->estado=="cancelado"){
            return view('modal/modalBuscarMovil')
                ->with('moviles', $moviles)
                ->with('solicitud',$solicitud)
                ->with('moviles_salida',$moviles_salida)
                ->with('moviles_regreso',$moviles_regreso);
        }
        if($solicitud->estado()->estado=="completado"){
            return view('modal/modalBuscarMovil')
                ->with('moviles', $moviles)
                ->with('solicitud',$solicitud)
                ->with('moviles_salida',$moviles_salida)
                ->with('moviles_regreso',$moviles_regreso);
        }
    }

    public function asignarMovil(Request $request){
    //  dd($request->all());
        $solicitud=Solicitud::find($request->solicitud_id);
        // modo editar movil
        if($request->modo=="editar"){
            $solicitudes_movil=SolicitudMovil::where('solicitud_id',$request->solicitud_id)->get();
            foreach ($solicitudes_movil as $key =>  $solicitud_movil) {
                $solicitud_movil->movil_id=$request->editar_movil_id;
                $solicitud_movil->save();
            }
            return redirect('/administrador')->with('status','movil editado');
        }
        // modo asignar, edito el estado de la solicitud a gestionado

        if($request->modo=="asignar"){
            // cambio estado a la solicitud
            $solicitud_estado= SolicitudEstado::find($solicitud->estado);
            $solicitud_estado->estado="gestionado";
            $solicitud_estado->observacion=$request->asignarObservacion;
            $solicitud_estado->save();
            // asigno viaje al movil, se calcula segun sea viaje de ida y vuelta
            // si es 1 es de ida y regreso por lo tanto asigno 2 viajes a ese movil
            if($solicitud->sentido==1){
                $solicitud_movil=new SolicitudMovil();
                $solicitud_movil->solicitud_id=$request->solicitud_id;
                $solicitud_movil->movil_id=$request->asignar_movil_id;
                $solicitud_movil->sentido="ida";
                $solicitud_movil->save();

                $solicitud_movil=new SolicitudMovil();
                $solicitud_movil->solicitud_id=$request->solicitud_id;
                $solicitud_movil->movil_id=$request->asignar_movil_id;
                $solicitud_movil->sentido="regreso";
                $solicitud_movil->save();

                return redirect('/administrador')->with('status','movil asignado');
            // si es 2, significa q es solo de ida por lo tanto asigno solo un viaje a ese movil
            }else{
                // creo el registro solicitud_movil
                $solicitud_movil=new SolicitudMovil();
                $solicitud_movil->solicitud_id=$request->solicitud_id;
                $solicitud_movil->movil_id=$request->asignar_movil_id;
                $solicitud_movil->sentido="ida";
                $solicitud_movil->save();
                return redirect('/administrador')->with('status','movil asignado');
            }
        }
        // modo rechazar solicitud
        if($request->modo=="rechazar"){
            $solicitud=Solicitud::find($request->solicitud_id);
            $solicitud_estado=SolicitudEstado::find($solicitud->estado);
            // dd($request->all(),$solicitud_estado);
            $solicitud_estado->estado="rechazado";
            $solicitud_estado->observacion=$request->rechazoObservacion;
            $solicitud_estado->save();
            return redirect('/administrador')->with('status','solicitud rechazada');
        }
        if($request->modo=="completar"){
            $solicitud=Solicitud::find($request->solicitud_id);
            $solicitud_estado=SolicitudEstado::find($solicitud->estado);
            $solicitud_estado->estado="completado";
            $solicitud_estado->observacion=$request->completarObservacion;
            $solicitud_estado->save();
            return redirect('/administrador')->with('status','solicitud completada');
        }

    }
    public function nuevoMovil(Request $request){
        // dd($request->all());
        $movil=Movil::create($request->all());
        return redirect('/administrador')->with('status','movil creado');
    }

    public function buscarDia($dia){
        // dd($dia);
        // $solicitudes=Solicitud::where('fecha_agendada',$dia)
        //             ->join('solicitud_estado','id','solicitudes.estado')->where('solicitud_estado.gestionado')
        //             ->join('solicitud_movil','solicitud_id','solicitudes.id')
        //             ->get();

        $solicitudes=Solicitud::where('fecha_agendada',$dia)
                ->join('solicitud_estado','solicitud_estado.id','solicitudes.estado')->where('solicitud_estado.estado','gestionado')
                ->join('solicitud_movil','solicitud_id','solicitudes.id')
                ->get();

        $id_vehiculos=[];

        foreach($solicitudes as $viaje){
            if(isset($viaje->movil_id)){
                array_push($id_vehiculos,$viaje->movil_id);
            }
            if($viaje->sentido=="ida"){
                $viaje->hora=$viaje->hora_salida;
            }else{
                $viaje->hora=$viaje->hora_llegada;
            }
        }

        $moviles=Movil::whereIn('id',array_unique($id_vehiculos))->get();
        $horas=["08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00"];
        // dd(count(array_unique($id_vehiculos)));
        $viajes=$solicitudes->sortBy('hora');
        // dd($solicitudes,$moviles,$viajes);
        return view('modal/modalBuscarDia')->with('viajes',$viajes)->with('fecha',$dia)->with('columnas',$moviles)->with('horas',$horas);
    }

}
