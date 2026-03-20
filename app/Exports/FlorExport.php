<?php

namespace App\Exports;

use App\Models\Flor;
use Maatwebsite\Excel\Concerns\FromCollection;

class FlorExport implements FromCollection
{
    public function collection()
    {
        return Flor::select("nome", "cor", "preco", "quantidade_estoque", "descricao")->get();
    }


    public function headings(): array
    {
        return [
            'Nome',
            'Cor',
            'Preço',
            'Quantidade em Estoque',
            'Descrição'
        ];
    }
}
