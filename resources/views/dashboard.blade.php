<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap');
        
        .dash-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dash-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .table-row {
            transition: background-color 0.2s ease;
        }
        .table-row:hover {
            background-color: #f9fafb;
        }
    </style>

    <div class="py-12" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="padding: 48px; background-color: #ffffff; border-radius: 32px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.02); border: 1px solid #f5f5f4;">
                
                <div style="margin-bottom: 48px; border-bottom: 1px solid #f5f5f4; padding-bottom: 24px;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 2.8rem; color: #1c1917; margin-bottom: 8px; letter-spacing: -0.02em; line-height: 1.2;">
                        Bem-vindo(a) à Perfurmer, <span style="color: #4a6741;">{{ ucwords(strtolower(Auth::user()->name)) }}</span> 🌿
                    </h2>
                    <p style="color: #78716c; font-size: 1.15rem; font-weight: 400; margin: 0;">Aqui está o resumo do desempenho da sua floricultura.</p>
                </div>

                <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-bottom: 48px;">
                    
                    <div class="dash-card" style="flex: 1; min-width: 280px; background: #ffffff; border-radius: 24px; border: 1px solid #e7e5e4; border-bottom: 5px solid #4a6741; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                        <a href="{{ route('flores.index') }}" style="text-decoration: none; color: inherit; display: block; padding: 32px;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <p style="margin: 0 0 8px 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Catálogo de Flores</p>
                                    <h3 style="margin: 0; font-size: 2.5rem; color: #1c1917; font-weight: 800; letter-spacing: -0.03em;">{{ $totalFlores ?? 0 }}</h3>
                                </div>
                                <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 16px; border-radius: 20px;">
                                    <svg style="width: 32px; height: 32px; color: #166534;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="dash-card" style="flex: 1; min-width: 280px; background: #ffffff; border-radius: 24px; border: 1px solid #e7e5e4; border-bottom: 5px solid #d4a373; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                        <a href="{{ route('clientes.index') }}" style="text-decoration: none; color: inherit; display: block; padding: 32px;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <p style="margin: 0 0 8px 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Clientes Ativos</p>
                                    <h3 style="margin: 0; font-size: 2.5rem; color: #1c1917; font-weight: 800; letter-spacing: -0.03em;">{{ $totalClientes ?? 0 }}</h3>
                                </div>
                                <div style="background: linear-gradient(135deg, #fffaf5 0%, #ffedd5 100%); padding: 16px; border-radius: 20px;">
                                    <svg style="width: 32px; height: 32px; color: #9a3412;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="dash-card" style="flex: 1; min-width: 280px; background: #ffffff; border-radius: 24px; border: 1px solid #e7e5e4; border-bottom: 5px solid #2d4739; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                        <a href="{{ route('pedidos.index') }}" style="text-decoration: none; color: inherit; display: block; padding: 32px;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <p style="margin: 0 0 8px 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Vendas do Mês</p>
                                    <h3 style="margin: 0; font-size: 2.5rem; color: #1c1917; font-weight: 800; letter-spacing: -0.03em;"><span style="font-size: 1.5rem; color: #a8a29e; margin-right: 4px;">R$</span>{{ number_format($faturamentoMensal ?? 0, 2, ',', '.') }}</h3>
                                </div>
                                <div style="background: linear-gradient(135deg, #f5f5f4 0%, #e7e5e4 100%); padding: 16px; border-radius: 20px;">
                                    <svg style="width: 32px; height: 32px; color: #2d4739;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div style="display: flex; gap: 32px; flex-wrap: wrap;">
                    
                    <div style="flex: 2; min-width: 320px; background: #ffffff; border: 1px solid #f5f5f4; padding: 32px; border-radius: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.02);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #1c1917; margin: 0;">Últimos Pedidos</h3>
                            <a href="{{ route('pedidos.index') }}" style="color: #4a6741; font-size: 0.9rem; font-weight: 600; text-decoration: none;">Ver todos &rarr;</a>
                        </div>
                        
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #f5f5f4;">
                                        <th style="padding: 0 0 16px 8px; color: #a8a29e; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Cliente</th>
                                        <th style="padding: 0 0 16px 8px; color: #a8a29e; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Valor Total</th>
                                        <th style="padding: 0 0 16px 8px; color: #a8a29e; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ultimosPedidos as $pedido)
                                        <tr class="table-row" style="border-bottom: 1px solid #f5f5f4;">
                                            <td style="padding: 20px 8px; color: #44403c; font-weight: 500;">{{ $pedido->cliente->nome ?? 'Cliente Avulso' }}</td>
                                            <td style="padding: 20px 8px; color: #1c1917; font-weight: 700;">R$ {{ number_format($pedido->valor_total ?? 0, 2, ',', '.') }}</td>
                                            <td style="padding: 20px 8px; text-align: right;">
                                                @if(strtolower($pedido->status ?? '') == 'entregue' || strtolower($pedido->status ?? '') == 'pago')
                                                    <span style="display: inline-block; background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 6px 14px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">{{ ucfirst($pedido->status) }}</span>
                                                @else
                                                    <span style="display: inline-block; background: #fffbeb; border: 1px solid #fde68a; color: #92400e; padding: 6px 14px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">{{ ucfirst($pedido->status ?? 'Pendente') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="padding: 32px 0; text-align: center; color: #a8a29e; font-style: italic;">Você ainda não possui nenhum pedido cadastrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 280px; background: #fafaf9; border: 1px solid #f5f5f4; padding: 32px; border-radius: 24px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #1c1917; margin: 0;">Atenção ao Estoque</h3>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @forelse ($estoqueBaixo as $flor)
                                <div style="background: #ffffff; border-left: 4px solid #ef4444; box-shadow: 0 2px 4px rgba(0,0,0,0.02); padding: 16px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <strong style="display: block; color: #7f1d1d; font-size: 0.95rem; margin-bottom: 4px;">{{ $flor->nome }}</strong>
                                        <span style="color: #b91c1c; font-size: 0.8rem; background: #fef2f2; padding: 2px 8px; border-radius: 6px;">Restam apenas {{ $flor->quantidade_estoque }}</span>
                                    </div>
                                    <svg style="width: 24px; height: 24px; color: #ef4444; opacity: 0.8;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                            @empty
                                <div style="background: #ffffff; border: 1px dashed #a7f3d0; padding: 32px 16px; border-radius: 16px; text-align: center;">
                                    <svg style="width: 40px; height: 40px; color: #10b981; margin: 0 auto 12px auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span style="display: block; color: #065f46; font-size: 1rem; font-weight: 600;">Tudo sob controle!</span>
                                    <p style="color: #059669; font-size: 0.85rem; margin: 4px 0 0 0;">Nenhum produto em falta.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>