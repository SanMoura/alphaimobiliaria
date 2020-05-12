<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_proposta extends Model
{
    protected $table = 'log_proposta';

    protected $fillable = [
        'dt_atendimento',
        'observacoes',
        'status_id',
        'proposta_id',
    ];

    public function proposta()
    {
        return $this->belongsTo(proposta::class, 'proposta_id');
    }

    public function anexos()
    {
        return $this->hasMany(Anexos::class, 'log_proposta_id');
    }

    public function status()
    {
        
        return $this->belongsTo(status::class, 'status_id');
    }

}
