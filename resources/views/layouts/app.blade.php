<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Floricultura') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair-display:700&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Pequeno ajuste para títulos ficarem com cara de boutique */
            h1, h2, h3, .navbar-brand { font-family: 'Playfair Display', serif; color: #2d4739; }
            .card { border-radius: 15px; border: none; }
            .btn-primary { background-color: #4a6741 !important; border-color: #4a6741 !important; } /* Verde Botânico */
            .btn-primary:hover { background-color: #3a5233 !important; }
            .navbar-brand{font-weight:800; 
            font-size:1.5rem;
            
            background-color: #e9f5e9; 
            border-bottom: 4px solid #4a6741; 
            font-size-adjust: 900%;
             
            border-right: 4px solid #4a6741;
            letter-spacing: 1px;
            border-bottom-left-radius: 20px !important;
            border-bottom-right-radius: 20px !important;}
            .nav-item { color: #2d4739 !important; font-weight: 500; }
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