@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cadastrar Novo Cliente</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone / WhatsApp</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>

            <hr>
<h5 class="mb-3">Endereço</h5>
<div class="row">
    <div class="col-md-3 mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" name="cep" id="cep" onblur="buscarCep()" placeholder="Apenas números">
    </div>
    <div class="col-md-7 mb-3">
        <label for="endereco" class="form-label">Endereço / Rua</label>
        <input type="text" class="form-control" name="endereco" id="endereco">
    </div>
    <div class="col-md-2 mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" class="form-control" name="numero" id="numero">
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" class="form-control" name="bairro" id="bairro">
    </div>
    <div class="col-md-5 mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade">
    </div>
    <div class="col-md-2 mb-3">
        <label for="estado" class="form-label">UF</label>
        <input type="text" class="form-control" name="estado" id="estado" maxlength="2">
    </div>
</div>

            <button type="submit" class="btn btn-success">Salvar Cliente</button>
        </form>
    </div>
</div>

<script>
    function buscarCep() {
        // Pega o valor do CEP e tira qualquer traço ou espaço
        let cep = document.getElementById('cep').value.replace(/\D/g, '');

        if (cep !== "") {
            let validacep = /^[0-9]{8}$/; // Regra: tem que ter 8 números
            
            if(validacep.test(cep)) {
                // Vai na internet buscar o CEP
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!("erro" in data)) {
                        // Se achou, preenche os campos automaticamente
                        document.getElementById('endereco').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                        
                        // Joga o cursor piscando direto pro campo "Número"
                        document.getElementById('numero').focus();
                    } else {
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                alert("Formato de CEP inválido.");
            }
        }
    }
</script>
@endsection