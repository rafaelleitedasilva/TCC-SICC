<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'Chamado';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $keyType = 'integer';
    
    // Defina os atributos preenchíveis em massa (fillable)
    protected $fillable = [
        'Nome',
        'Solicitante',
        'ObjetoID',
        'SetorID',
        'Descricao',
        'Grau',
        'Processo',
        'created_at',
        'Empresa',
    ];
    
    public function Objeto()
    {
        return $this->belongsTo(Objeto::class, 'ObjetoID');
    }
    
    public function Setor()
    {
        return $this->belongsTo(Setor::class, 'SetorID');
    }
}
