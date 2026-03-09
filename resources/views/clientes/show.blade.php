@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Perfil do Cliente</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm mb-4 border-info">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Dados de Contato</h5>
    </div>
    <div class="card-body">
        <h4 class="card-title">{{ $cliente->nome }}</h4>
        <p class="card-text mb-1"><strong>📧 E-mail:</strong> {{ $cliente->email }}</p>
        <p class="card-text"><strong>📱 Telefone:</strong> {{ $cliente->telefone }}</p>
    </div>
</div>

<h4 class="mb-3">📦 Histórico de Pedidos</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nº do Pedido</th>
                    <tbody>
                @forelse($cliente->pedidos as $pedido)
                    <tr>
                        <td>#{{ $pedido->id }}</td>
                        <td>{{ $pedido->data_pedido->format('d/m/Y') }}</td>
                        <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $pedido->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-outline-secondary">Ver Detalhes</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Este cliente ainda não fez nenhum pedido.
                        </td>
                    </tr>
                @endforelse
            </tbody>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Estamos quase lá! Precisamos conectar as tabelas para listar os pedidos aqui.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection