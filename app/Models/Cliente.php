<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Garantindo que o Laravel olhe para a tabela certa
    protected $table = 'clientes';

    // Colunas que podem ser preenchidas ao criar ou atualizar um cliente
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco'
    ];

    // Relacionamento: Um cliente possui vários pedidos (1 para N)
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}