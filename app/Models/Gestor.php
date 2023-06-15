<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'ID';
    protected $table = 'Gestor';
}
