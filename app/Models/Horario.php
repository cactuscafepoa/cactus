<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_mes',
        'dia_mes_mostrar',
        'dia_semana',
        'aberto',
        'hora_abre',
        'hora_fecha',
        'aviso',
        'atendimento_fisico',
        'atendimento_encomendas',
    ];        
}