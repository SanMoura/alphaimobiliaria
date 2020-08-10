<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\User;

class PropostaUsers extends Model
{
    protected $table = 'proposta_users';

    protected $fillable = [
        'user_id_adicional', 'proposta_id', 'user_id'
    ];


    public function usuarios_proposta()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
