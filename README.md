# Mini ERP

Este é um sistema Mini ERP desenvolvido como teste técnico, implementado em Laravel 12 com Livewire, MySQL e integração com a API ViaCEP. O projeto inclui funcionalidades para cadastro de produtos, gerenciamento de carrinho, aplicação de cupons, finalização de pedidos com envio de e-mails e um webhook para atualizar o status de pedidos.

## Funcionalidades
- **Cadastro de Produtos**: Permite cadastrar produtos com nome, preço, variações e estoque.
- **Carrinho**: Adiciona produtos ao carrinho, valida CEPs com a API ViaCEP, aplica cupons e calcula fretes (R$15 para subtotal entre R$52 e R$166,59; grátis acima de R$200; R$20 para outros casos).
- **Cupons**: Gerencia cupons com código, desconto, valor mínimo e validade.
- **Webhook**: Atualiza o status de pedidos (pendente, confirmado, cancelado) ou deleta pedidos cancelados.
- **E-mails**: Envia e-mails com detalhes do pedido ao finalizá-lo.

## Tecnologias
- **Backend**: Laravel 12, Livewire
- **Banco de Dados**: MySQL
- **Integrações**: API ViaCEP, Mailtrap (para envio de e-mails)
- **Frontend**: Bootstrap 5

## Requisitos
- PHP >= 8.1
- Composer
- Node.js e npm
- MySQL
- Laravel Herd (opcional, para ambiente local)
- Conta Mailtrap para envio de e-mails

## Instalação
1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/mini-erp.git
   cd mini-erp
