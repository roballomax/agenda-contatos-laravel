<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = "categorias.categorias";

    protected function subcategorias(){
        $this->hasMany(Subcategoria::class);
    }

}
