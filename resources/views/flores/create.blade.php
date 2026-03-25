@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cadastrar Nova Flor</h2>
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
        <form action="{{ route('flores.store') }}" method="POST" enctype="multipart/form-data">
            
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome da Flor</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6">
                    <label for="cor" class="form-label">Cor (Ex: Vermelha, Branca)</label>
                    <input type="text" class="form-control" id="cor" name="cor" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
                </div>
                <div class="col-md-6">
                    <label for="foto">Selecione uma foto</label>
                   <input type="file" name="imagem" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Salvar Flor</button>
        </form>
    </div>
</div>
@endsection