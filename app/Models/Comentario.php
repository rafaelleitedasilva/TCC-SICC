<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'Comentario';
    protected $primaryKey = 'ID';

    public function Usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
