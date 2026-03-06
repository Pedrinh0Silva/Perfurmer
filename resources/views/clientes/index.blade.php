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
                    <th>Pedidos</th> <th>Ações</th>
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
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-primary">Editar</a>
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