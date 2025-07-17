<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produto;
use App\Models\Estoque;

class ProdutoCreate extends Component
{
    public $nome = '';
    public $preco = 0;
    public $variacoes = [];
    public $quantidades = [];

    public function mount()
    {
        $this->variacoes = [];
        $this->quantidades = [];
    }

    public function render()
    {
        return view('livewire.produto-create');
    }

    public function adicionarVariacao()
    {
        $this->variacoes[] = '';
        $this->quantidades[] = 0;
    }

    public function salvar()
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'variacoes.*' => 'nullable|string|max:255',
            'quantidades.*' => 'required|integer|min:0',
        ]);

        $produto = Produto::create([
            'nome' => $this->nome,
            'preco' => $this->preco,
        ]);

        foreach ($this->variacoes as $index => $variacao) {
            if ($this->quantidades[$index] > 0) {
                Estoque::create([
                    'produto_id' => $produto->id,
                    'variacao' => $variacao ?: null,
                    'quantidade' => $this->quantidades[$index],
                ]);
            }
        }

        session()->flash('message', 'Produto salvo com sucesso!');
        $this->reset();
    }
}
