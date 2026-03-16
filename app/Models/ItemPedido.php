<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    // Garante que usemeos a tabela correta
    protected $table = 'item_pedidos';

    // Dados que queremos colertar do cliente
    protected $fillable = [
        'pedido_id',
        'flor_id',
        'quantidade',
        'preco_unitario',
        'subtotal'
    ];

    // RELACIONAMENTO: Este item de pedido PERTENCE A um Pedido   
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // RELACIONAMENTO: Este item de pedido SE REFERE A uma Flor
    public function flor()
    {
        return $this->belongsTo(Flor::class);
    }
}