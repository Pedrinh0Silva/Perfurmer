@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Vendas</h2>
    <a href="{{ route('pedidos.create') }}" class="btn btn-success">Nova Venda</a>
</div>

  <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0"></h2>

        <a href="{{ route('flores.export') }}" class="btn btn-success">
            Exportar Vendas
        </a>
    </div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr>
                        <td>#{{ $pedido->id }}</td>
                        <td>{{ $pedido->cliente->nome }}</td>
                        <td>{{ $pedido->data_pedido->format('d/m/Y') }}</td>
                        <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td><span class="badge bg-success">{{ ucfirst($pedido->status) }}</span></td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-outline-primary">Ver Recibo</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Nenhuma venda realizada ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection