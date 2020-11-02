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
        'fonte_id',
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

    public function acompanhamento()
    {
        return $this->hasMany(acompCliente::class, 'cliente_id');
    }

    public function fonte()
    {
        return $this->belongsTo(Fonte::class, 'fonte_id');
    }

    // public function usuario()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }



}
