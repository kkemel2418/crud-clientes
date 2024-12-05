<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = ['id_cliente', 'nome_contato', 'email_contato', 'fone_contato', 'cpf'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
  
    public function setCpfAttribute($value)
   {
      $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
    }

     /*
   protected $casts = [
    'id_cliente' => 'integer',
   ]; */

    
}
