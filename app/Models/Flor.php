<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flor extends Model
{
    use HasFactory;

    // Garante que usemeos a tabela correta

    // Dados que queremos colertar do cliente
    protected $fillable = [
        'nome',
        'cor',
        'preco',
        'quantidade_estoque',
        'descricao',
        'imagem'
    ];

    // RELACIONAMENTO: Uma flor pode estar em vários itens de pedido N p N
        public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}