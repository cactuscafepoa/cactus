<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Storage;

class Categoria extends Model
{
    use HasFactory;
    //use softDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'visivel',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected static function booted()
    {
        static::creating(function($dataset) {
            $dataset->slug = Str::slug($dataset->nome);
        });

        // SE ALTERAR O NOME DO PRODUTO
        static::updating(function($dataset) {
            $dataset->slug = Str::slug($dataset->nome);
        });

    }

    public function produtos() {
        return $this->hasMany(Produto::class);
    }

    public function getImagemAttribute($value)
    {
        return Storage::url($value);
    }    
}