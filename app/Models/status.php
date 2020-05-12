<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $table = 'status';

    public function log_proposta()
    {
        return $this->hasMany(log_proposta::class, 'status_id');
    }
}
