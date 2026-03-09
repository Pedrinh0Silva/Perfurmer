@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Registrar Nova Venda</h2>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-success">
    <div class="card-body">
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="cliente_id" class="form-label text-success fw-bold">1. Selecione o Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" required>
                    <option value="">-- Escolha um cliente --</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }} ({{ $cliente->email }})</option>
                    @endforeach
                </select>
            </div>

            <hr>

            <div class="mb-4">
                <label class="form-label text-success fw-bold">2. Escolha o Produto</label>
                <div class="row">
                    <div class="col-md-8">
                        <label for="flor_id" class="form-label">Flor</label>
                        <select class="form-select" id="flor_id" name="itens[0][flor_id]" required>
                            <option value="">-- Escolha uma flor --</option>
                            @foreach($flores as $flor)
                                <option value="{{ $flor->id }}">
                                    {{ $flor->nome }} - R$ {{ number_format($flor->preco, 2, ',', '.') }} (Estoque: {{ $flor->quantidade_estoque }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="itens[0][quantidade]" min="1" value="1" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 fs-5">Finalizar Venda</button>
        </form>
    </div>
</div>
@endsection