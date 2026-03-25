<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cliente;
use App\Models\Flor;
use App\Models\Pedido;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nivel_acesso',
    ];

    /**
     * Esconde o atributo
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * O atributo que deve aparecer
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function floresOcultas()
    {
        // 'flor_id' deve ser igual ao nome na sua migration image_a6f76c.png
        return $this->belongsToMany(Flor::class, 'ocultos', 'user_id', 'flor_id');
    }
    public function clientesOcultos()
    {
        return $this->belongsToMany(Cliente::class, 'ocultos', 'user_id', 'clientes_id');
    }
    public function pedidosOcultos()
    {
        return $this->belongsToMany(Pedido::class, 'ocultos', 'user_id', 'pedidos_id');
    }
}
