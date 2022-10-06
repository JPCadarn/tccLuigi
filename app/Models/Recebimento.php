<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'descricao',
        'paciente',
        'modo_recebimento',
        'data_vencimento',
        'data_recebimento'
    ];
}
