@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cadastrar Nova Flor</h2>
    <a href="{{ route('flores.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('flores.store') }}" method="POST">
            
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome da Flor</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo (Ex: Rosa, Orquídea)</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" required>
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
                    <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Salvar Flor</button>
        </form>
    </div>
</div>
@endsection