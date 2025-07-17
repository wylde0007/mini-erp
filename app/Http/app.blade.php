<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mini ERP</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('produtos') }}">Produtos</a>
                <a class="nav-link" href="{{ route('carrinho') }}">Carrinho</a>
                <a class="nav-link" href="{{ route('cupons') }}">Cupons</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        {{ $slot }}
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
