<!DOCTYPE html>
<html>
<head>
    <title>Pedido Finalizado</title>
</head>
<body>
    <h1>Seu Pedido #{{ $pedido->id }}</h1>
    <p>Subtotal: R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}</p>
    <p>Frete: R$ {{ number_format($pedido->frete, 2, ',', '.') }}</p>
    <p>Endereço: {{ json_decode($pedido->endereco)->logradouro }}, {{ json_decode($pedido->endereco)->bairro }}, {{ json_decode($pedido->endereco)->localidade }} - {{ json_decode($pedido->endereco)->uf }}</p>
    <p>CEP: {{ $pedido->cep }}</p>
    <p>Obrigado pela sua compra!</p>
</body>
</html>
