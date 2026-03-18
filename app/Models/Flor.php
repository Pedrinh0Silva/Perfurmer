<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flor extends Model
{
    use HasFactory;

    // Garante que usemeos a tabela correta
    protected $table = 'flores';
    // Dados que queremos colertar do cliente
    protected $fillable = [
        'nome',
        'cor',
        'preco',
        'quantidade_estoque',
        'descricao',
        'imagem'
    ];

    
        public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}