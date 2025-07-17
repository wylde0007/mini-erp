<div>
    <div class="container">
        <h2>Carrinho</h2>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="mb-3">
            <h4>Itens no Carrinho</h4>
            @if (!empty($carrinho))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Variação</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carrinho as $key => $quantidade)
                            @php
                                [$produto_id, $variacao] = explode('-', $key);
                                $produto = \App\Models\Produto::find($produto_id);
                            @endphp
                            @if ($produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $variacao === 'default' ? '-' : $variacao }}</td>
                                    <td>{{ $quantidade }}</td>
                                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($produto->preco * $quantidade, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Carrinho vazio.</p>
            @endif
        </div>
        <div class="mb-3">
            <h4>Adicionar Produto</h4>
            <form wire:submit.prevent="adicionar">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" wire:model="produto_id">
                            <option value="">Selecione um produto</option>
                            @foreach (\App\Models\Produto::all() as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                        @error('produto_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" wire:model="variacao" placeholder="Variação (opcional)">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="mb-3">
            <h4>Verificar CEP</h4>
            <form wire:submit.prevent="verificarCep">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" wire:model="cep" placeholder="Digite o CEP">
                        @error('cep') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-secondary">Verificar CEP</button>
                    </div>
                </div>
            </form>
            @if (isset($endereco) && is_array($endereco) && !isset($endereco['erro']))
                <p>Endereço: {{ $endereco['logradouro'] }}, {{ $endereco['bairro'] }}, {{ $endereco['localidade'] }} - {{ $endereco['uf'] }}</p>
            @endif
        </div>
        <div class="mb-3">
            <h4>Aplicar Cupom</h4>
            <form wire:submit.prevent="calcularTotais">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" wire:model="cupom_codigo" placeholder="Código do cupom">
                        @error('cupom_codigo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-secondary">Aplicar Cupom</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="mb-3">
            <h4>Resumo do Pedido</h4>
            <p>Subtotal: R$ {{ number_format($subtotal ?? 0.0, 2, ',', '.') }}</p>
            <p>Desconto: R$ {{ number_format($desconto ?? 0.0, 2, ',', '.') }}</p>
            <p>Frete: R$ {{ number_format($frete ?? 0.0, 2, ',', '.') }}</p>
            <p>Total: R$ {{ number_format(($subtotal ?? 0.0) - ($desconto ?? 0.0) + ($frete ?? 0.0), 2, ',', '.') }}</p>
        </div>
        <button wire:click="finalizar" class="btn btn-success">Finalizar Pedido</button>
    </div>
</div>
