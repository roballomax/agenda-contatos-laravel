<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Subcategoria extends Model
{
    protected $table = "categorias.subcategorias";

    protected function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }
}
