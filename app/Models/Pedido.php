<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Nome da tabela
    protected $table = 'pedidos';

    // Colunas permitidas para preenchimento (Mass Assignment)
    protected $fillable = [
        'cliente_id',
        'data_pedido',
        'valor_total',
        'status'
    ];

    // Dica extra: O Laravel pode converter automaticamente a data para um objeto Carbon,
    // facilitando na hora de formatar a data na tela (ex: d/m/Y)
    protected $casts = [
        'data_pedido' => 'date',
    ];

    // Relacionamento 1: Um pedido PERTENCE A um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento 2: Um pedido TEM MUITOS itens (preparando para a próxima tabela)
    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}