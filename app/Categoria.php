<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = "categorias.categorias";

    protected $fillable = ['nome', 'descricao', 'user_id'];

    protected function subcategorias(){
        $this->hasMany(Subcategoria::class);
    }

}
