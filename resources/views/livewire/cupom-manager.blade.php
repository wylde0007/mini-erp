<div>
    <div class="container">
        <h2>Gerenciar Cupons</h2>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="salvar">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" class="form-control" wire:model="codigo">
                @error('codigo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Desconto (R$)</label>
                <input type="number" step="0.01" class="form-control" wire:model="desconto">
                @error('desconto') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Valor Mínimo (R$)</label>
                <input type="number" step="0.01" class="form-control" wire:model="valor_minimo">
                @error('valor_minimo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Validade</label>
                <input type="date" class="form-control" wire:model="validade">
                @error('validade') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Salvar Cupom</button>
        </form>
        <div class="mt-4">
            <h4>Cupons Cadastrados</h4>
            @if (isset($cupons) && $cupons->isEmpty())
                <p>Nenhum cupom cadastrado.</p>
            @elseif (isset($cupons))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Desconto</th>
                            <th>Valor Mínimo</th>
                            <th>Validade</th>
                            <th>Ativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cupons as $cupom)
                            <tr>
                                <td>{{ $cupom->codigo }}</td>
                                <td>R$ {{ number_format($cupom->desconto, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($cupom->valor_minimo, 2, ',', '.') }}</td>
                                <td>{{ $cupom->validade->format('d/m/Y') }}</td>
                                <td>{{ $cupom->ativo ? 'Sim' : 'Não' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Erro ao carregar cupons.</p>
            @endif
        </div>
    </div>
</div>
