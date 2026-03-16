<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'data_pedido', 'valor_total', 'status'];

    // Para a data funcionar no formato brasileiro (d/m/Y)
    protected $casts = [
        'data_pedido' => 'datetime',
    ];

    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    
    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}