<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Floricultura') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair-display:700&display=swap"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Pequeno ajuste para títulos ficarem com cara de boutique */
        h1,

        h3,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            color: #2d4739;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .btn-primary {
            background-color: #4a6741 !important;
            border-color: #4a6741 !important;
        }

        /* Verde Botânico */
        .btn-primary:hover {
            background-color: #3a5233 !important;
        }

        body {
            background-color: #f3f5f2 !important;
            /* Um cinza esverdeado bem clarinho */
            font-family: 'Figtree', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #edfcf5f8 0%, #f1f4f0 100%) !important;
            font-family: 'Figtree', sans-serif;
            color: #2d3748;
        }

        /* 2. Navbar com Efeito "Glass" (Vidro) */
        nav,
        .bg-white.border-b {
            background: rgba(235, 250, 244, 0.986) !important;
            backdrop-filter: blur(12px) !important;
            border: 1px solid rgba(153, 196, 136, 0.8) !important;
            /* Efeito de desfoque profissional */
            border-bottom: 1px solid rgba(74, 103, 65, 0.1) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03) !important;
        }

        /* 3. Cards Premium (Efeito Flutuante) */
        .card {
            border: 1px solid rgba(153, 196, 136, 0.8) !important;
            margin-top: 55px !important;
            /* Borda interna de brilho */
            border-radius: 24px !important;
            background: #ffffff !important;
            box-shadow: 0 15px 35px -5px rgba(45, 71, 57, 0.08) !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
       

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 45px -10px rgba(74, 103, 65, 0.15) !important;
            
        }

        /* 4. Tipografia de Título (Diferenciada) */
        h1,
        .navbar-brand span {
            font-family: 'Playfair Display', serif !important;

            letter-spacing: -0.5px;
            color: #1a2e23 !important;
        }

        /* 5. Botões com Gradiente Botânico */
        .btn-primary {
            background: linear-gradient(135deg, #4a6741 0%, #3a5233 100%) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 10px 24px !important;
            font-weight: 400 !important;
            box-shadow: 0 4px 15px rgba(74, 103, 65, 0.2) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover {
            filter: brightness(1.1);
            box-shadow: 0 8px 20px rgba(74, 103, 65, 0.3) !important;
            transform: scale(1.02);
        }

        .btn-success {
            background: linear-gradient(135deg, #5b8451 0%, #4a6741 100%) !important;
            border: none !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            /* Transição suave */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px !important;
            padding: 5px 24px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 15px rgba(91, 132, 81, 0.2) !important;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            filter: brightness(1.1);
            box-shadow: 0 8px 20px rgba(91, 132, 81, 0.3) !important;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 15px rgba(74, 103, 65, 0.2);
        }
        .btn-sm {
           
            border: none !important;
            border-radius: 12px !important;
            padding: 5px 24px !important;
            font-weight: 400 !important;
            box-shadow: 0 4px 15px rgba(74, 103, 65, 0.2) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-sm:hover {
            filter: brightness(1.1);
            box-shadow: 0 8px 20px rgba(74, 103, 65, 0.3) !important;
            transform: scale(1.02);
        }

        /* 6. Cores de Status (Substituindo o Bootstrap comum) */
        .text-success {
            color: #5b8451 !important;
        }

        .bg-success {
            background-color: #e9f5e9 !important;
            color: #2d4739 !important;
        }

        /* 7. Input/Search Styles */
        input,
        select {
            border-radius: 10px !important;
            border: 1px solid #e2e8f0 !important;
            padding: 10px !important;
        }

        .flor-thumb-container {
            width: 80px;
            /* Largura fixa da moldura */
            height: 80px;
            /* Altura fixa da moldura (quadrada) */
            border-radius: 12px;
            /* Bordas arredondadas orgânicas */
            overflow: hidden;
            /* Corta o que sobrar da imagem */
            border: 2px solid #e9f5e9;
            /* Borda bem fina verde-clara */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            /* Sombra leve */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            /* Fundo caso a imagem falhe */
        }

        .flor-thumb-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* MÁGICA: A imagem preenche o quadrado sem esticar */
            object-position: center;
            /* Foca no centro da flor */
        }

        /* 2. Estilização da Tabela (Menos Excel, Mais Boutique) */
        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            /* Cria espaço entre as linhas */
        }

        .body.table thead th {
            border: none !important;
            color: #4a6741 !important;
            /* Verde botânico nos títulos */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding-bottom: 15px !important;
        }

        .body .table tbody tr {
            background-color: #4a6741 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02) !important;
            /* Sombra leve em cada linha */
            transition: transform 0.2s ease !important;
        }
        .body .table table:hover {
            background-color: #4a6741 !important;

        }

        .body .table tbody tr:hover {
            transform: translateY(-3px);
            /* Linha "levita" no hover */
            background-color: #4a6741 !important;
        }

        .body .table tbody td {
            border: none !important;
            vertical-align: middle !important;
            /* Centraliza tudo verticalmente */
            padding: 15px !important;
            color: #2d3748;
        }

        /* Bordas arredondadas nas pontas das linhas */
        .body .table tbody tr td:first-child {
            border-radius: 12px 0 0 12px !important;
        }

        .body .table tbody tr td:last-child {
            border-radius: 0 12px 12px 0 !important;
        }

        /* 3. Ajuste dos Botões de Ação */
        .body .table .btn-sm {
            border-radius: 8px !important;
            padding: 5px 15px !important;
            font-size: 0.75rem;
        }

        label,
        .text-gray-600,
        .text-sm {
            color: #2d3748 !important;
            /* Um cinza chumbo bem visível */
        }

        /* Garante que os títulos dentro dos cards brancos fiquem escuros */
        .card h2,
        .card h3,
        .bg-white h2 {
            color: #1a2e23 !important;

        }

        /* Ajuste para os Inputs (caso o texto digitado esteja branco também) */
        input,
        textarea {
            color: #1a202c !important;
            /* Texto preto/grafite ao digitar */
            background-color: #ffffff !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-stone-50 text-gray-800">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white shadow-sm mb-4 border-b border-stone-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="container py-4">
            <div class="card shadow-sm p-4 bg-white border-top border-4 border-success">
                @yield('conteudo')

                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>