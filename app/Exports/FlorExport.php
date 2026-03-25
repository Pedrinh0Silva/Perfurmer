<?php

namespace App\Exports;

use App\Models\Flor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FlorExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * PASSO 1: BUSCA NO BANCO
     */
    public function collection()
    {
        // Vai na tabela "flores", seleciona apenas as colunas especificadas e traz todos os registros (get).
        return Flor::select("nome", "cor", "preco", "quantidade_estoque", "descricao")->get();
    }

    /**
     * PASSO 2: CRIA A PRIMEIRA LINHA
     */
    public function headings(): array
    {
        // Retorna um array simples onde cada posição representa uma coluna na planilha.
        return [
            'Nome',
            'Cor',
            'Preço (R$)',
            'Quantidade em Estoque',
            'Descrição'
        ];
    }

    /**
     * PASSO 3: FORMATAÇÃO LINHA A LINHA
     * O pacote Excel pega a coleção acima e passa item por item aqui dentro.
     */
    public function map($flor): array
    {
        // O array retornado aqui DEVE ter a mesma quantidade e ordem de itens do método headings().
        return [
            $flor->nome, // Acessa o atributo "nome" do objeto flor.
            ucfirst($flor->cor), // Transforma "amarelo" em "Amarelo".
            number_format($flor->preco, 2, ',', '.'), // Formata o valor decimal do banco (ex: 15.50) para moeda (15,50).
            $flor->quantidade_estoque, // Insere o número inteiro diretamente.
            $flor->descricao // Insere o texto longo. Como usamos ShouldAutoSize, a coluna vai esticar para caber esse texto.
        ];
    }
}