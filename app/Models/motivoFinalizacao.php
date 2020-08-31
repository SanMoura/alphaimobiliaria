<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class motivoFinalizacao extends Model
{
    protected $table = 'motivo_finalizacao';

    public function proposta()
    {
        return $this->belongsTo(proposta::class, 'proposta_id');
    }
}
