<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'ID';
    protected $table = 'Setor';

    public function Gestor()
    {
        return $this->belongsTo(User::class, 'GestorID');
    }
}
