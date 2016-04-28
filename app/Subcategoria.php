<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = "categorias.subcategorias";

    protected function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
