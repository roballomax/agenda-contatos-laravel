<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Subcategoria extends Model
{
    protected $table = "categorias.subcategorias";

    protected $fillable = ['nome', 'categoria_id', 'user_id'];

    protected function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }
}
