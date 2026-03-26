@extends('layouts.app')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fs-3 fw-light text-muted text-uppercase" style="letter-spacing: 2px;">
            Lista de Vendas
        </h2>
        <a href="{{ route('pedidos.create') }}" class="btn btn-success">Nova Venda</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0"></h2>
        <a href="{{ route('pedidos.export') }}" class="btn btn-success">
            Exportar Vendas
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
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
                                <div class="d-flex gap-2">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-outline-primary">Ver Recibo</a>
                                    
                                    @auth

                                        @if(Auth::user()->is_admin)
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-{{ $pedido->id }}">
                                                Excluir
                                            </button>
                                        @else
                                            <form action="{{ route('pedidos.ocultar', $pedido->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning">Ocultar</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
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
@auth
        @if(Auth::user()->is_admin)
            @foreach($pedidos as $pedido)
                <div class="modal fade" id="deleteModal-{{ $pedido->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $pedido->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel-{{ $pedido->id }}">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body text-wrap text-break">
                                Tem certeza que deseja excluir o pedido <strong>{{ $pedido->id }}</strong>? Esta ação não pode ser desfeita.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endauth