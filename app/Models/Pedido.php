<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal',
        'frete',
        'cep',
        'endereco',
        'status',
    ];

    protected $casts = [
        'endereco' => 'array',
        'status' => 'string',
    ];
}
