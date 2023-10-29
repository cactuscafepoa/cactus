<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;

    protected $fillable = [
        'pagina_inicial',
        'pagina_inicial_titulo',
        'pagina_inicial_texto',
        'botao_inicial',
        'cardapio',
        'prato_dia',
        'prato_dia_titulo',
        'prato_dia_texto',
        'encomendas',
        'encomendas_titulo',
        'encomendas_texto',
        'novidades',
        'horario',
        'evento_id',
        'cardapio_fisico_qtd'
    ];
}
