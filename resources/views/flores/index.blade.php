@extends('layouts.app')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Flores</h2>
    <a href="{{ route('flores.create') }}" class="btn btn-success">Nova Flor</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th> <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
                </tr>
            </thead>
            <tbody>
                @forelse($flores as $flor)
                    <tr>
                        <td>{{ $flor->id }}</td>
                        <td>{{ $flor->nome }}</td>
                        <td>{{ $flor->tipo }}</td> <td>R$ {{ number_format($flor->preco, 2, ',', '.') }}</td>
                        <td>{{ $flor->quantidade_estoque }}</td>
                        <td>
                            <a href="{{ route('flores.edit', $flor->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhuma flor cadastrada ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection