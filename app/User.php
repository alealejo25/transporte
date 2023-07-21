<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function PagoMetropolitana()
    {
        return $this->hasMany('App\PagoMetropolitana');
    }
    public function PagoWorldline()
    {
        return $this->hasMany('App\PagoWorldline');
    }
    public function OpComprasVarias()
    {
        return $this->hasMany('App\OpComprasVarias');
    }
    public function ComprasVarias()
    {
        return $this->hasMany('App\ComprasVarias');
    }
    public function VentaTafi()
    {
        return $this->hasMany('App\VentaTafi');
    }
    public function CierreDiaTafi()
    {
        return $this->hasMany('App\CierreDiaTafi');
    }

    public function MovimentoCajaTafi()
    {
        return $this->hasMany('App\MovimentoCajaTafi');
    }
     public function BoletoLeagas()
    {
        return $this->hasMany('App\BoletoLeagas');
    }
       public function Gasoil()
    {
        return $this->hasMany('App\Gasoil');
    }
     public function PlanchaTafi()
    {
        return $this->hasMany('App\PlanchaTafi');
    }
    
}
