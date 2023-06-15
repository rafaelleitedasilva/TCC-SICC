<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'ID';
    protected $table = 'objeto';

    public function Setor()
    {
        return $this->belongsTo(Setor::class, 'SetorID');
    }
}
