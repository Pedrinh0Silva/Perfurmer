@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Perfil do Cliente</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm mb-4 border-info">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Dados de Contato</h5>
    </div>
    <div class="card-body">
        <h4 class="card-title">{{ $cliente->nome }}</h4>
        <p class="card-text mb-1"><strong>📧 E-mail:</strong> {{ $cliente->email }}</p>
        <p class="card-text"><strong>📱 Telefone:</strong> {{ $cliente->telefone }}</p>
    </div>
</div>

@if($cliente->endereco)
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">📍 Localização no Mapa</h5>
        </div>
        
        <div class="card-body p-0">
            @php
                // Juntando as peças para o Google entender exatamente onde é
                $enderecoCompleto = "{$cliente->endereco}, {$cliente->numero} - {$cliente->bairro}, {$cliente->cidade} - {$cliente->estado}, {$cliente->cep}";
            @endphp
            
            <iframe 
                width="100%" 
                height="400" 
                frameborder="0" 
                scrolling="no" 
                marginheight="0" 
                marginwidth="0" 
                src="https://maps.google.com/maps?q={{ urlencode($enderecoCompleto) }}&output=embed"
                style="border-bottom-left-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
            </iframe>
        </div>
        
        <div class="card-footer bg-light text-center">
            <small class="text-muted">{{ $enderecoCompleto }}</small>
        </div>
    </div>
@else
    <div class="alert alert-warning mt-4">
        Este cliente ainda não possui endereço cadastrado para exibir no mapa.
    </div>
@endif

<h4 class="mb-3">📦 Histórico de Pedidos</h4>
<div class="card shadow-sm">
    <div class="card-body p-0"> <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nº do Pedido</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cliente->pedidos as $pedido)
                    <tr>
                        <td>#{{ $pedido->id }}</td>
                        <td>{{ $pedido->data_pedido->format('d/m/Y') }}</td>
                        <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-primary">{{ ucfirst($pedido->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-outline-secondary">Ver Detalhes</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            Este cliente ainda não fez nenhum pedido.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection