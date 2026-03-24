@extends('layouts.app')

@section('conteudo')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fs-3 fw-light text-muted text-uppercase" style="letter-spacing: 2px;">
            Lista de Flores
        </h2>
        <a href="{{ route('flores.create') }}" class="btn btn-success">Nova Flor</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Cor</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($flores as $flor)
                        <tr>
                            <td>{{ $flor->id }}</td>
                            <td class="text-center">
                                <div class="flor-thumb-container mx-auto"> <img src="{{ asset('storage/' . $flor->imagem) }}"
                                        alt="{{ $flor->nome }}">
                                </div>
                            </td>
                            <td>{{ $flor->nome }}</td>
                            <td>{{ $flor->cor }}</td>
                            <td>R$ {{ number_format($flor->preco, 2, ',', '.') }}</td>
                            <td>{{ $flor->quantidade_estoque }}</td>
                            <td>
                                <a href="{{ route('flores.edit', $flor->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                @auth
                                    @if(Auth::user()->is_admin)
                                        <form action="{{ route('flores.destroy', $flor->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta flor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    @endif
                                @endauth
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