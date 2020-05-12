<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class proposta extends Model
{
    protected $table = 'proposta';

    protected $fillable = [
        'user_id',
        'cliente_id'
    ];


    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'cliente_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function log_proposta()
    {
        return $this->hasMany(log_proposta::class, 'proposta_id');
    }

    public function status()
    {
         return self::log_proposta()->with('status');
    }

}
