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
        <form action="{{ route('pedidos.store') }}" method="POST" id="form-venda">
            @csrf

            <div class="mb-4">
                <label for="cliente_id" class="form-label text-success fw-bold">1. Selecione o Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id" required>
                    <option value="">-- Escolha um cliente --</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }} ({{ $cliente->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>

            <div class="mb-4">
                <label class="form-label text-success fw-bold">2. Adicione os Produtos</label>
                <div class="row align-items-end">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="flor_selector" class="form-label">Flor</label>
                        <select class="form-select" id="flor_selector">
                            <option value="">-- Escolha uma flor --</option>
                            @foreach($flores as $flor)
                                <option value="{{ $flor->id }}" data-preco="{{ $flor->preco }}" data-nome="{{ $flor->nome }}" data-estoque="{{ $flor->quantidade_estoque }}">
                                    {{ $flor->nome }} - R$ {{ number_format($flor->preco, 2, ',', '.') }} (Estoque: {{ $flor->quantidade_estoque }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="qtd_selector" min="1" value="1">
                    </div>
                    <div class="col-md-3">
                        <button type="button" onclick="adicionarAoCarrinho()" class="btn btn-primary w-100">
                            + Adicionar
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produto</th>
                            <th class="text-center">Qtd</th>
                            <th class="text-end">Preço Un.</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody id="carrinho-body">
                        </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mb-4">
                <h4 class="text-success mb-0">Total: R$ <span id="total-display">0,00</span></h4>
            </div>

            <div id="inputs-escondidos"></div>

            <button type="button" onclick="validarEEnviar()" class="btn btn-success w-100 fs-5">✔ Finalizar Venda</button>
        </form>
    </div>
</div>

<script>
    let carrinho = [];

    function adicionarAoCarrinho() {
        const selector = document.getElementById('flor_selector');
        const option = selector.options[selector.selectedIndex];
        
        if (!option.value) {
            alert('Por favor, selecione uma flor primeiro.');
            return;
        }

        const qtdInput = document.getElementById('qtd_selector');
        const qtd = parseInt(qtdInput.value);
        const estoqueDisponivel = parseInt(option.getAttribute('data-estoque'));

        if (qtd < 1) {
            alert('A quantidade deve ser pelo menos 1.');
            return;
        }

        const flor = {
            id: option.value,
            nome: option.getAttribute('data-nome'),
            preco: parseFloat(option.getAttribute('data-preco')),
            quantidade: qtd,
            estoque: estoqueDisponivel
        };

        const indexExistente = carrinho.findIndex(item => item.id === flor.id);
        
        if (indexExistente >= 0) {
            if ((carrinho[indexExistente].quantidade + flor.quantidade) > flor.estoque) {
                alert(`Estoque insuficiente! O máximo para ${flor.nome} é de ${flor.estoque} unidades.`);
                return;
            }
            carrinho[indexExistente].quantidade += flor.quantidade;
        } else {
            if (flor.quantidade > flor.estoque) {
                alert(`Estoque insuficiente! O máximo para ${flor.nome} é de ${flor.estoque} unidades.`);
                return;
            }
            carrinho.push(flor);
        }

        selector.value = '';
        qtdInput.value = 1;
        atualizarTela();
    }

    function removerDoCarrinho(index) {
        carrinho.splice(index, 1);
        atualizarTela();
    }

    function atualizarTela() {
        const tbody = document.getElementById('carrinho-body');
        const inputsDiv = document.getElementById('inputs-escondidos');
        let htmlTabela = '';
        let htmlInputs = '';
        let totalGeral = 0;

        if (carrinho.length === 0) {
            htmlTabela = '<tr><td colspan="5" class="text-center text-muted py-3">Nenhum produto adicionado.</td></tr>';
        } else {
            carrinho.forEach((item, index) => {
                const subtotal = item.quantidade * item.preco;
                totalGeral += subtotal;

                htmlTabela += `
                    <tr>
                        <td>${item.nome}</td>
                        <td class="text-center fw-bold">${item.quantidade}</td>
                        <td class="text-end">R$ ${item.preco.toFixed(2).replace('.', ',')}</td>
                        <td class="text-end fw-bold">R$ ${subtotal.toFixed(2).replace('.', ',')}</td>
                        <td class="text-center">
                            <button type="button" onclick="removerDoCarrinho(${index})" class="btn btn-sm btn-danger">X</button>
                        </td>
                    </tr>
                `;

                // Cria o Array que vai pro Laravel
                htmlInputs += `
                    <input type="hidden" name="itens[${index}][flor_id]" value="${item.id}">
                    <input type="hidden" name="itens[${index}][quantidade]" value="${item.quantidade}">
                `;
            });
        }

        tbody.innerHTML = htmlTabela;
        inputsDiv.innerHTML = htmlInputs;
        document.getElementById('total-display').innerText = totalGeral.toFixed(2).replace('.', ',');
    }

    function validarEEnviar() {
        if (carrinho.length === 0) {
            alert('Adicione pelo menos uma flor antes de finalizar a venda!');
            return;
        }
        
        const clienteSelect = document.getElementById('cliente_id');
        if (!clienteSelect.value) {
            alert('Selecione o cliente para a venda.');
            clienteSelect.focus();
            return;
        }

        document.getElementById('form-venda').submit();
    }

    // Inicia a tabela vazia
    atualizarTela();
</script>
@endsection