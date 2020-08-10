<?php

namespace App;



//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Cargos;
use App\Models\proposta;
// use App\Models\cliente;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'cargo_id', 'rg', 'cpf','password','foto',
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

    public function proposta_user()
    {
        return $this->hasMany(proposta::class, 'user_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }

    
    // public function cliente()
    // {
    //     return $this->hasMany(cliente::class, 'user_id');
    // }
}
