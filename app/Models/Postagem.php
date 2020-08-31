<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $table = 'postagem';

    protected $fillable = [
        'titulo',
        'sub_titulo',
        'imagem',
        'descricao',
        'data',
        'user_id',
    ];


    
    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
