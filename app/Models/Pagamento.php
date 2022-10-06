<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'pago_a',
        'valor',
        'modo_pagamento',
        'data_vencimento',
        'data_pagamento'
    ];
}
