@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Flor: {{ $flor->nome }}</h2>
    <a href="{{ route('flores.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
     <form action="{{ route('flores.update', $flor->id) }}" method="POST">
            @csrf
            
            @method('PUT') 

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
                <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $flor->descricao }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="{{ $flor->preco }}" required>
                </div>
                <div class="col-md-6">
                    <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque" value="{{ $flor->quantidade_estoque }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection