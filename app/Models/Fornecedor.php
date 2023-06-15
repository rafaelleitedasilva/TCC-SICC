<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'ID';
    protected $table = 'Fornecedor';

    public function Item()
    {
        return $this->belongsTo(Item::class, 'IDItem');
    }
}
