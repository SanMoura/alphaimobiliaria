<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'fonte',
        'telefone',
        'renda',
        'observacoes',
        'data',
        'user_id'
    ];


    public function proposta()
    {
        return $this->hasMany(proposta::class, 'cliente_id');
    }

    // public function usuario()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }



}
