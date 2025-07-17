<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'desconto',
        'valor_minimo',
        'validade',
        'ativo',
    ];

    protected $casts = [
        'validade' => 'date',
        'ativo' => 'boolean',
    ];
}
