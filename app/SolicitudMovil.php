<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Movil;

class SolicitudMovil extends Model
{
    use SoftDeletes;
    protected $table='solicitud_movil';

    public function movil(){
        return  $this->hasOne('App\Movil', 'id', 'movil_id');
    }

}
