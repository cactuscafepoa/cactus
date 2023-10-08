<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Storage;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'marca',
        'volume',
        'tipo_volume',
        'ncm',
        'preco',
        'preco_venda',
        'quantidade',
        'fornecedor_id',
        'imagem',
        'link',
        'destaque',
        'destaque_texto',
        'encomenda',
        'encomenda_preco_venda',
        'encomenda_quantidade_minima',
        'encomenda_prazo_minimo',
        'prato_dia',
        'visivel',
        'visivel_cardapio_fisico',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected static function booted()
    {
        static::creating(function($produto) {
            $produto->slug = Str::slug($produto->nome);
        });

        // SE ALTERAR O NOME DO PRODUTO
        static::updating(function($produto) {
            $produto->slug = Str::slug($produto->nome);
        });

    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getImagemAttribute($value)
    {
        return Storage::url($value);
    }
}