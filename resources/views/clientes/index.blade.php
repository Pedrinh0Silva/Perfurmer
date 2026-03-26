@extends('layouts.app')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">Novo Cliente</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail / Contato</th>
                        <th>Pedidos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nome }}</td>
                            <td>
                                <div>{{ $cliente->email ?? 'Sem e-mail' }}</div>
                                <small class="text-muted">{{ $cliente->telefone ?? 'Sem telefone' }}</small>
                            </td>
                            <td>
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-outline-info">
                                    Ver Pedidos
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                                        class="btn btn-sm btn-primary">Editar</a>

                                    @auth

                                        @if(Auth::user()->is_admin)
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-{{ $cliente->id }}">
                                                Excluir
                                            </button>
                                        @else
                                            <form action="{{ route('clientes.ocultar', $cliente->id) }}" method="POST">
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
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum cliente cadastrado ainda.
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
        @foreach($clientes as $cliente)
            <div class="modal fade" id="deleteModal-{{ $cliente->id }}" tabindex="-1"
                aria-labelledby="deleteModalLabel-{{ $cliente->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $cliente->id }}">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body text-wrap text-break">
                            Tem certeza que deseja excluir o cliente <strong>{{ $cliente->nome }}</strong>? Esta ação não pode ser
                            desfeita.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
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