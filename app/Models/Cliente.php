<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nome da tabela no banco de dados
    protected $fillable = ['nome', 'cnpj', 'endereco', 'status']; // Campos editáveis
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true; // Permite que o Laravel gerencie created_at e updated_at automaticamente

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }
    

}
