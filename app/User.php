<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='users';
    protected $fillable = [
        'name',
        'login',
        'apellidos',
        'es_admin',
        'habilitado',
        'telefono',
        'direccion',
        'titulo',
        'nacimiento',
        'ultimo_ingreso',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'cal_passwd', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function obtenerTipoUsuario()
    {
        return $this->hasOne('App\UserType', 'id','user_type')->first()->tx_descripcion;
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
