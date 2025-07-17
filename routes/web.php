<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', function () {
    return view('livewire.produto-create');
})->name('produtos');

Route::get('/carrinho', function () {
    return view('livewire.carrinho');
})->name('carrinho');

Route::get('/cupons', function () {
    return view('livewire.cupom-manager');
})->name('cupons');

Route::get('/', function () {
    return 'Servidor funcionando!';
});

Route::post('/webhook/pedido', [WebhookController::class, 'handle'])->name('webhook.pedido');
