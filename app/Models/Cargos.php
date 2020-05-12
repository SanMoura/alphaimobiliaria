<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cargos extends Model
{
    protected $table = 'cargo';

    protected $fillable = ['ds_cargo'];

    public function usuario()
    {
        return $this->hasMany(User::class, 'cargo_id');
    }
}
