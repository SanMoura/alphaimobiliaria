<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{
    protected $table = 'anexos';

    protected $fillable = [
        'nome',
        'nomeOriginal',
        'log_proposta_id',
        'proposta_id',
    ];

    public function log_proposta()
    {
        return $this->belongsTo(log_proposta::class, 'proposta_id');
    }

    
    // public function proposta()
    // {
    //      return self::log_proposta()->with('proposta');
    // }

}
