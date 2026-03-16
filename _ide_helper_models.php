<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string|null $telefone
 * @property string|null $endereco
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cep
 * @property string|null $numero
 * @property string|null $bairro
 * @property string|null $cidade
 * @property string|null $estado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pedido> $pedidos
 * @property-read int|null $pedidos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEndereco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 */
	class Cliente extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemPedido> $itensPedido
 * @property-read int|null $itens_pedido_count
 * @method static \Database\Factories\FlorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Flor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flor query()
 */
	class Flor extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $pedido_id
 * @property int $flor_id
 * @property int $quantidade
 * @property string $preco_unitario
 * @property string $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Flor $flor
 * @property-read \App\Models\Pedido $pedido
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereFlorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido wherePedidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido wherePrecoUnitario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereQuantidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPedido whereUpdatedAt($value)
 */
	class ItemPedido extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cliente_id
 * @property \Illuminate\Support\Carbon $data_pedido
 * @property string $valor_total
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cliente $cliente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemPedido> $itens
 * @property-read int|null $itens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDataPedido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereValorTotal($value)
 */
	class Pedido extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $nivel_acesso
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNivelAcesso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

