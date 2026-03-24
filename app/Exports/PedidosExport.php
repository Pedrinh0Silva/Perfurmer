<?php

// Define o "endereço" desta classe dentro do projeto Laravel.
namespace App\Exports;

// Importação das classes e interfaces que vamos usar neste arquivo.
use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

// A palavra "implements" obriga a classe a ter os métodos exigidos pelas interfaces do Laravel Excel.
class PedidosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * PASSO 1: COLETA DOS DADOS
     * O Laravel Excel chama este método primeiro para saber o que colocar na planilha.
     */
    public function collection()
    {
        // Sintaxe "Pedido::" (método estático) inicia a consulta no banco de dados.
        // "with('cliente')" faz o Eager Loading (carrega os clientes junto com os pedidos para evitar lentidão).
        return Pedido::with('cliente')
            ->select('id', 'cliente_id', 'data_pedido', 'valor_total', 'status', 'forma_pagamento', 'created_at')
            ->get(); // O "->get()" executa a consulta e retorna uma Coleção (array de objetos) do Laravel.
    }

    /**
     * PASSO 2: CABEÇALHOS
     * Define o que será escrito na primeira linha (A1, B1, C1...) do Excel.
     */
    public function headings(): array // ": array" é a tipagem do PHP informando que o retorno deve ser um array.
    {
        return [
            'ID do Pedido',
            'Cliente', 
            'Data do Pedido',
            'Valor Total (R$)',
            'Status',
            'Forma de Pagamento',
            'Criado em',
        ];
    }

    /**
     * PASSO 3: MAPEAMENTO
     * Este método é executado automaticamente em um "loop" para CADA pedido retornado no passo 1.
     * A variável "$pedido" recebe o objeto atual do loop.
     */
    public function map($pedido): array
    {
        return [
            // Sintaxe "$objeto->propriedade" acessa o valor da coluna no banco.
            $pedido->id,
            
            // Operador ternário (Condição ? Se Verdadeiro : Se Falso).
            // Se o relacionamento cliente existir, pega o nome. Se não (cliente deletado, ex), pega o ID bruto.
            $pedido->cliente ? $pedido->cliente->nome : $pedido->cliente_id, 
            
            // Carbon::parse() transforma a string de data do banco em um objeto de data.
            // ->format() converte para o padrão brasileiro Dia/Mês/Ano.
            Carbon::parse($pedido->data_pedido)->format('d/m/Y'),
            
            // number_format nativo do PHP: 2 casas decimais, vírgula para decimal, ponto para milhar.
            number_format($pedido->valor_total, 2, ',', '.'),
            
            // ucfirst() nativo do PHP: Deixa a primeira letra da string em maiúscula.
            ucfirst($pedido->status), 
            ucfirst($pedido->forma_pagamento),
            
            // Verifica se "created_at" não é nulo. Se tiver data, formata com hora e minuto. Senão, retorna 'N/D' (Não Disponível).
            $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/D',
        ];
    }
}