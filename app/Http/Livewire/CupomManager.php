<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cupom;

class CupomManager extends Component
{
    public $codigo = '';
    public $desconto = 0.0;
    public $valor_minimo = 0.0;
    public $validade = '';
    public $cupons = [];

    public function mount()
    {
        $this->cupons = Cupom::all();
    }

    public function render()
    {
        $this->cupons = Cupom::all();
        return view('livewire.cupom-manager', [
            'cupons' => $this->cupons,
        ]);
    }

    public function salvar()
    {
        $this->validate([
            'codigo' => 'required|string|max:50|unique:cupons',
            'desconto' => 'required|numeric|min:0',
            'valor_minimo' => 'required|numeric|min:0',
            'validade' => 'required|date|after:today',
        ]);

        Cupom::create([
            'codigo' => $this->codigo,
            'desconto' => $this->desconto,
            'valor_minimo' => $this->valor_minimo,
            'validade' => $this->validade,
        ]);

        $this->cupons = Cupom::all();
        $this->reset(['codigo', 'desconto', 'valor_minimo', 'validade']);
        session()->flash('message', 'Cupom criado com sucesso!');
    }
}
