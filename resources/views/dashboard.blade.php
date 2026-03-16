<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="padding: 40px; background-color: #fafaf9; border-radius: 20px; box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);">
                
                <div style="margin-bottom: 40px;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 2.8rem; color: #1c1917; margin-bottom: 8px; letter-spacing: -0.02em;">
                        Bem-vindo à Perfurmer, {{ ucwords(strtolower(Auth::user()->name)) }} 🌿
                    </h2>
                    <p style="color: #57534e; font-size: 1.2rem; font-weight: 400;">Aqui está o resumo da sua Floricultura hoje.</p>
                </div>

                <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                    
                    <div style="flex: 1; min-width: 280px; background: white; padding: 30px; border-radius: 24px; border-left: 6px solid #4a6741; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div style="background: #f0fdf4; padding: 15px; border-radius: 15px;">
                                <span style="font-size: 30px;">🌷</span>
                            </div>
                            <div>
                                <p style="margin: 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em;">Catálogo de Flores</p>
                                <h3 style="margin: 0; font-size: 2.2rem; color: #1c1917; font-weight: 800;">{{ $totalFlores ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 280px; background: white; padding: 30px; border-radius: 24px; border-left: 6px solid #d4a373; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div style="background: #fffaf5; padding: 15px; border-radius: 15px;">
                                <span style="font-size: 30px;">👥</span>
                            </div>
                            <div>
                                <p style="margin: 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em;">Clientes Ativos</p>
                                <h3 style="margin: 0; font-size: 2.2rem; color: #1c1917; font-weight: 800;">{{ $totalClientes ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 280px; background: white; padding: 30px; border-radius: 24px; border-left: 6px solid #2d4739; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div style="background: #f5f5f4; padding: 15px; border-radius: 15px;">
                                <span style="font-size: 24px; font-weight: 900; color: #2d4739;">R$</span>
                            </div>
                            <div>
                                <p style="margin: 0; color: #78716c; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em;">Vendas do Mês</p>
                                <h3 style="margin: 0; font-size: 2.2rem; color: #1c1917; font-weight: 800;">{{ number_format($faturamentoMensal ?? 0, 2, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>