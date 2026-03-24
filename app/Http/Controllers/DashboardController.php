<?php

namespace App\Http\Controllers;

use App\Models\Flor;
use App\Models\Cliente;
use App\Models\Pedido; // <--- Importação correta do model
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Os dados que você provavelmente já tem:
        $totalFlores = Flor::count();
        $totalClientes = Cliente::count();
        
        // CORRIGIDO: Alterado de Venda:: para Pedido::
        $faturamentoMensal = Pedido::whereMonth('created_at', Carbon::now()->month)->sum('valor_total');

        // NOVOS DADOS PARA A TABELA E AVISOS:
        
        // CORRIGIDO: Alterado de Venda:: para Pedido::
        // Pega os 5 pedidos mais recentes (carregando os dados do cliente junto)
        $ultimosPedidos = Pedido::with('cliente')->latest()->take(5)->get();

        // Pega as flores que estão com quantidade menor ou igual a 5 no estoque
        $estoqueBaixo = Flor::where('quantidade', '<=', 5)->get();

        // Envia tudo para a view
        return view('dashboard', compact(
            'totalFlores', 
            'totalClientes', 
            'faturamentoMensal', 
            'ultimosPedidos', 
            'estoqueBaixo'
        ));
    }
}