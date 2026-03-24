<?php

namespace App\Exports;

use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class PedidosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Se você tiver o relacionamento configurado no Model Pedido, 
        // use Pedido::with('cliente')->get() para evitar o problema de N+1 queries.
        return Pedido::all();
    }

    /**
     * Define os cabeçalhos da planilha Excel.
     */
    public function headings(): array
    {
        return [
            'ID do Pedido',
            'Cliente', // Se tiver o nome do cliente, mude para 'Cliente'
            'Data do Pedido',
            'Valor Total (R$)',
            'Status',
            'Forma de Pagamento',
            'Criado em',
        ];
    }

    /**
     * Mapeia os dados de cada linha. Aqui formatamos os valores antes de ir pro Excel.
     */
    public function map($pedido): array
    {
        return [
            $pedido->id,
            $pedido->cliente_id, // Ex: $pedido->cliente->nome (se tiver o relacionamento)
            Carbon::parse($pedido->data_pedido)->format('d/m/Y'), // Formata a data: 23/03/2026
            number_format($pedido->valor_total, 2, ',', '.'),     // Formata moeda: 1.500,00
            $pedido->status,
            $pedido->forma_pagamento,
            $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/D',
        ];
    }
}