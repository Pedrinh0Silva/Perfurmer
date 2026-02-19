<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    // Garantindo que o Laravel encontre a tabela exata (com o underline)
    protected $table = 'item_pedidos';

    // Colunas permitidas para preenchimento (Mass Assignment)
    protected $fillable = [
        'pedido_id',
        'flor_id',
        'quantidade',
        'preco_unitario',
        'subtotal'
    ];

    // Relacionamento 1: Este item de pedido PERTENCE A um Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Relacionamento 2: Este item de pedido SE REFERE A uma Flor
    public function flor()
    {
        return $this->belongsTo(Flor::class);
    }
}