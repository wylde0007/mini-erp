<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'status' => 'required|in:pendente,confirmado,cancelado',
        ]);

        $pedido = Pedido::find($request->pedido_id);

        if ($request->status === 'cancelado') {
            $pedido->delete();
        } else {
            $pedido->update(['status' => $request->status]);
        }

        return response()->json(['message' => 'Webhook processado com sucesso']);
    }
}
