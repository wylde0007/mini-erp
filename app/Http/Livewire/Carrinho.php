<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Cupom;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail; // Adicione esta linha

class Carrinho extends Component
{
    public $carrinho = [];
    public $cep = '';
    public $endereco = null;
    public $cupom_codigo = '';
    public $subtotal = 0.0;
    public $frete = 0.0;
    public $desconto = 0.0;
    public $produto_id = null;
    public $variacao = '';

    public function mount()
    {
        $this->carrinho = session()->get('carrinho', []);
        $this->cep = '';
        $this->endereco = null;
        $this->cupom_codigo = '';
        $this->subtotal = 0.0;
        $this->frete = 0.0;
        $this->desconto = 0.0;
        $this->produto_id = null;
        $this->variacao = '';
        $this->calcularTotais();
    }

    public function adicionar()
    {
        $this->validate([
            'produto_id' => 'required|exists:produtos,id',
            'variacao' => 'nullable|string|max:255',
        ]);

        $produto = Produto::findOrFail($this->produto_id);
        $estoque = Estoque::where('produto_id', $this->produto_id)
                          ->where('variacao', $this->variacao ?: null)
                          ->first();

        if ($estoque && $estoque->quantidade > 0) {
            $key = $this->produto_id . '-' . ($this->variacao ?: 'default');
            $this->carrinho[$key] = ($this->carrinho[$key] ?? 0) + 1;
            $estoque->decrement('quantidade');
            session()->put('carrinho', $this->carrinho);
            $this->calcularTotais();
            session()->flash('message', 'Produto adicionado ao carrinho!');
        } else {
            $this->addError('produto_id', 'Produto ou variação sem estoque.');
        }
    }

    public function calcularTotais()
    {
        $this->subtotal = 0.0;
        foreach ($this->carrinho as $key => $quantidade) {
            [$produto_id, $variacao] = explode('-', $key);
            $produto = Produto::find($produto_id);
            if ($produto) {
                $this->subtotal += $produto->preco * $quantidade;
            }
        }

        if ($this->subtotal >= 52 && $this->subtotal <= 166.59) {
            $this->frete = 15.0;
        } elseif ($this->subtotal > 200) {
            $this->frete = 0.0;
        } else {
            $this->frete = 20.0;
        }

        if ($this->cupom_codigo) {
            $cupom = Cupom::where('codigo', $this->cupom_codigo)
                          ->where('ativo', true)
                          ->where('validade', '>=', now())
                          ->first();
            if ($cupom && $this->subtotal >= $cupom->valor_minimo) {
                $this->desconto = $cupom->desconto;
            } else {
                $this->desconto = 0.0;
                $this->addError('cupom_codigo', 'Cupom inválido ou não aplicável.');
            }
        }
    }

    public function verificarCep()
    {
        $this->validate([
            'cep' => 'required|string|size:8',
        ]);

        $response = Http::get("https://viacep.com.br/ws/{$this->cep}/json/");
        if ($response->successful() && !isset($response->json()['erro'])) {
            $this->endereco = $response->json();
            session()->flash('message', 'CEP validado com sucesso!');
        } else {
            $this->endereco = null;
            $this->addError('cep', 'CEP inválido');
        }
    }

    public function finalizar()
    {
        $this->validate([
            'cep' => 'required|string|size:8',
            'endereco' => 'required|array',
        ]);

        $pedido = Pedido::create([
            'subtotal' => $this->subtotal - $this->desconto,
            'frete' => $this->frete,
            'cep' => $this->cep,
            'endereco' => json_encode($this->endereco),
        ]);

        // Enviar e-mail
        Mail::to('cliente@example.com')->send(new \App\Mail\PedidoFinalizado($pedido));

        session()->forget('carrinho');
        $this->reset(['carrinho', 'cep', 'endereco', 'cupom_codigo', 'subtotal', 'frete', 'desconto', 'produto_id', 'variacao']);
        session()->flash('message', 'Pedido finalizado com sucesso!');
    }

    public function render()
    {
        $this->calcularTotais();
        return view('livewire.carrinho');
    }
}
