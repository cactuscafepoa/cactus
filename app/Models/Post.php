<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'user_id',
        'titulo',
        'imagem',
        'conteudo'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
