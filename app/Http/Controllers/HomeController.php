<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Solicitud;
use App\SolicitudEstado;
use App\SolicitudMovil;
use Auth;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
         $this->middleware('rol:3;1');
    }

    public function enrutador(){
        $user = Auth::user();
        switch ($user->obtenerTipoUsuario()) {
            case 'Administrador':
                return redirect('/administrador');
                break;
            case 'Trabajador':
                return redirect('/trabajador');
                break;
            default:
                return redirect('/trabajador');
                break;
        }
    }

    public function index()
    {
        // dd('aqui');
        $userId=1;
        $eventsAll=Solicitud::where('estado', "pendiente")->orWhere("usuario_agendador_id",1)->get();
        $eventsUser=Solicitud::where("usuario_agendador_id",1)->take(5)->get();
        $eventsJson=[];

        setlocale(LC_ALL, 'es_MX', 'es', 'ES');

        if(!$eventsAll->isEmpty()){

            foreach ($eventsAll as $evento) {
                $hora_salida=str_replace(' ', '', $evento->hora_salida);
                $hora_llegada= str_replace(' ', '', $evento->hora_llegada);

                $hA=Carbon::createFromFormat('Y-m-d H:i', $evento->fecha_agendada.' '.$hora_salida)->toDateTimeString();;

                $hB=Carbon::createFromFormat('Y-m-d H:i', $evento->fecha_agendada.' '.$hora_llegada)->toDateTimeString();;
            //    dd( $evento->fecha_agendada,$hora_salida,$hA,$hB);


            switch ($evento->estado()->estado) {
                case 'cancelado':
                        $estadoColor='#f0ad4e';
                        // $estadoColor='#889929';
                    break;
                case 'gestionado':
                        $estadoColor='#7a54f5'; // AZUL BKN
                        // $estadoColor='#7a54f5'; //  MORADO BKN
                    break;
                case 'copletado':
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
                'estado'         => $evento->estado,
                'id'         => $evento->id,
                'title'      => $evento->destino,
                'start'      => $hA,
                'end'        => $hB,
                'backgroundColor'=>$estadoColor,
                'borderColor'=> $estadoColor,
                'allDay'=> false,
            ];


                // $eventsJson[]       = [
                //     'id'         => $evento->id,
                //     'title'      => $evento->destino,
                //     'start'      => $hA,
                //     'end'        => $hB,
                //     'backgroundColor'=>'#f56954',
                //     'borderColor'=> '#f56954',
                //     'allDay'=> false,
                // ];
            }
        }else{
            $eventsAll=null;
        }


        if(!$eventsUser->isEmpty()){
            foreach ($eventsUser as $evento) {
                // $hora_salida=str_replace(' ', '', $evento->hora_salida);
                // $hora_llegada= str_replace(' ', '', $evento->hora_llegada);

                // $hA=Carbon::createFromFormat('Y-m-d h:iA', $evento->fecha_agendada.' '.$hora_salida)->format('c');
                // $hB=Carbon::createFromFormat('Y-m-d g:iA', $evento->fecha_agendada.' '.$hora_llegada)->format('c');
                                    //

                                    $hora_salida=Carbon::parse(str_replace(' ', '', $evento->hora_salida))->format('H:i');
                                    $hora_llegada=Carbon::parse(str_replace(' ', '', $evento->hora_llegada))->format('H:i');

                                    $fechaArray=explode("-",$evento->fecha_agendada);
                                    $fecha = Carbon::parse($evento->fecha_agendada)->locale('es')->formatLocalized('%b');
                                    $evento->month=str_replace('.', '', $fecha);
                                    $evento->year= $fechaArray[0];
                                    $evento->day= $fechaArray[2];
                                    $evento->salida= $hora_salida;
                                    $evento->llegada= $hora_llegada;
            }
        }else{
             $eventUser=null;
        }


        return view('home', compact('eventsJson','eventsUser'));
    }

    public function buscarViaje($id_solicitud){

        // $solicitud=Solicitud::find($id_solicitud);
        $solicitud=Solicitud::find($id_solicitud);
        // dd($id_solicitud);
        return view('modal/modalVerSolicitud')->with('solicitud',$solicitud);
    }

    public function editarSolicitud(Request $request){
        // dd($request->all());
        $solicitud=Solicitud::find($request->solicitud_id);

        if($request->modo=="cancelar"){
            // cambio el estado de la solicitud
            $solicitud_estado=SolicitudEstado::find($solicitud->estado);
            $solicitud_estado->estado="cancelado";
            $solicitud_estado->observacion=$request->cancelarObservacion;
            $solicitud_estado->save();
            // libero movil
            $solicitud_movil=SolicitudMovil::where('solicitud_id',$solicitud->id)->first();
            $solicitud_movil->estado_movil_id=1;
            $solicitud_movil->save();

            return redirect('/')->with('status','viaje cancelado');
        }
    }

    public function solicitudesBuscar(){
            $solicitudes=Solicitud::where('usuario_agendador_id',Auth::user()->id)->get();
            // dd($solicitudes);
            return view('/usuarios/solicitudes')->with('solicitudes',$solicitudes);
    }

}
