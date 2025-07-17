<div>
    <div class="container">
        <h2>Cadastro de Produto</h2>
        <form wire:submit.prevent="salvar">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" wire:model="nome">
                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="number" step="0.01" class="form-control" wire:model="preco">
                @error('preco') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <h4>Variações</h4>
                @if (!empty($variacoes))
                    @foreach ($variacoes as $index => $variacao)
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control" wire:model="variacoes.{{ $index }}" placeholder="Variação (opcional)">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" wire:model="quantidades.{{ $index }}" placeholder="Quantidade">
                                @error("quantidades.{$index}") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endforeach
                @endif
                <button type="button" class="btn btn-secondary" wire:click="adicionarVariacao">Adicionar Variação</button>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
