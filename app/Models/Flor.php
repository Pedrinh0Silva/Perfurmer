<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flor extends Model
{
    use HasFactory;

    // 1. Avisando o Laravel o nome exato da tabela
    protected $table = 'flores';

    // 2. Liberando as colunas para cadastro em massa (Mass Assignment)
    protected $fillable = [
        'nome',
        'tipo',
        'preco',
        'quantidade_estoque',
        'descricao',
        'imagem'
    ];

    // 3. O relacionamento (Uma flor pode estar em vários itens de pedido)
    // Vamos manter ele aqui preparado!
    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}