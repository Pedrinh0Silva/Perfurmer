@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Recibo da Venda #{{ $pedido->id }}</h2>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar para Vendas</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4 border-info">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Dados do Cliente</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $pedido->cliente->nome }}</h5>
                <p class="mb-1">📧 {{ $pedido->cliente->email }}</p>
                <p class="mb-0">📱 {{ $pedido->cliente->telefone }}</p>
            </div>
        </div>

        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Resumo do Pedido</h5>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>Data:</strong> {{ $pedido->data_pedido->format('d/m/Y') }}</p>
                <p class="mb-1"><strong>Status:</strong> <span class="badge bg-primary">{{ ucfirst($pedido->status) }}</span></p>
                <hr>
                <h4 class="text-success text-center">Total: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Produtos Comprados (Itens)</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produto (Flor)</th>
                            <th class="text-center">Qtd</th>
                            <th>Preço Unit.</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->itens as $item)
                            <tr>
                                <td><strong>{{ $item->flor->nome }}</strong></td>
                                <td class="text-center">{{ $item->quantidade }}</td>
                                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                <td><strong>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection