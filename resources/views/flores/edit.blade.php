@extends('layouts.app')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Flor: {{ $flor->nome }}</h2>
        <a href="{{ route('flores.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('flores.update', $flor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
               

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome da Flor</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $flor->nome }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cor" class="form-label">Cor</label>
                        <input type="text" class="form-control" id="cor" name="cor" value="{{ $flor->cor }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao"
                        rows="3">{{ $flor->descricao }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="preco" class="form-label">Preço (R$)</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                            value="{{ $flor->preco }}" required>
                    </div>
                    <div class="form-group">
                        <label>Imagem Atual:</label><br>
                        @if($flor->imagem)
                            <img src="{{ asset('storage/' . $flor->imagem) }}" width="150" class="mb-2">
                        @else
                            <p>Nenhuma imagem cadastrada.</p>
                        @endif

                        <label>Trocar Imagem:</label>
                        <input type="file" name="imagem" class="form-control">
                        <small class="text-muted">Deixe em branco para manter a foto atual.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                        <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque"
                            value="{{ $flor->quantidade_estoque }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>
@endsection