<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Solicitud;

class Movil extends Model
{
    use SoftDeletes;
    protected $table='moviles';
    protected $fillable = ['nombre_conductor', 'modelo_vehiculo', 'marca','capacidad','patente'];

    public function solicitudes(){
        return $this->hasMany('App\SolicitudMovil','movil_id','id');
    }

}
