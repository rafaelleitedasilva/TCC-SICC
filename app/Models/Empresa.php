<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'empresas';
    public $timestamps = false;
}
