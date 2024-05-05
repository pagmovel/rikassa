<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricao';

    protected $fillable = [
        'nome','email','whatsapp','nascimento','altura','cidade',
        'estado','foto','profissao','idiomas','nacionalidade',
        'interesses_pessoais','experiencia_previa','instagram','facebook',
        'x_twitter','concordo','confirmou_email', 'pagou','data_pagamento',
    ];

}