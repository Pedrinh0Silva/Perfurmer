<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Garante que usemeos a tabela correta
    protected $table = 'clientes';

    // Dados que queremos colertar do cliente
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco'
    ];

    // Relacionamento: Um cliente possui vários pedidos
    // 1 + N
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
    public function usuariosQueOcultaram()
{
    
    return $this->belongsToMany(User::class, 'ocultos', 'clientes_id', 'user_id');
}
}