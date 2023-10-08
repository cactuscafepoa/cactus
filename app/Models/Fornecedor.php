<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Storage;

class Fornecedor extends Model
{
    use HasFactory;
    //use softDeletes;

    protected $table = 'fornecedores';

    protected $fillable = [
    'nome',
	'endereco',
	'numero',
	'cidade',
	'fone1',
	'fone2',
	'fone3',
    ];

    protected $dates = [
        'deleted_at',
    ];
}