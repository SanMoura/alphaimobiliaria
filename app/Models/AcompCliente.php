<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcompCliente extends Model
{
    protected $table = 'acomp_cliente';

    protected $fillable = [
        'cliente_id',
        'status_id',
        'observacoes'
    ];

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'cliente_id');
    }

    public function status()
    {
        return $this->belongsTo(status::class, 'status_id');
    }
}
