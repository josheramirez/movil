<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\SolicitudEstado;
use Auth;

class SolicitudController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('rol:3;1');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $fecha=str_replace('/', '-', $request->viaje_fecha_salida);
        $fecha2=date('Y-m-d', strtotime($fecha));
        // dd($request->all(),$fecha2,$fecha);
        $solicitud=new Solicitud();
        $solicitud->origen="Servicio occidente";
        $solicitud->destino=$request->viaje_destino;
        $solicitud->pasajeros=$request->viaje_pasajeros;
        $solicitud->sentido=$request->viaje_sentido;
        $solicitud->fecha_agendada=$fecha2;
        $solicitud->hora_salida=str_replace(' ', '', $request->viaje_hora_salida);
        $solicitud->hora_llegada=str_replace(' ', '', $request->viaje_hora_regreso);
        $solicitud->usuario_agendador_id=Auth::user()->id;

        $solicitud_estado=new SolicitudEstado();
        $solicitud_estado->estado="pendiente";
        $solicitud_estado->observacion="";
        $solicitud_estado->save();
        $solicitud->estado=$solicitud_estado->id;
        $solicitud->save();

        return redirect('/')->with('message', "store-success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarSolicitud($id)
    {
        $solicitud=Solicitud::find($id);
        return view('/modal/editarSolicitud')->with('solicitud',$solicitud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
