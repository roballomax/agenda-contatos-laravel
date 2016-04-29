<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Categoria extends Model
{

    protected $table = "categorias.categorias";

    protected $fillable = ['nome', 'descricao', 'user_id'];

    protected static function lista_todas_do_user(){
        return Categoria::where('user_id', Auth::user()->id)
            ->orderBy('nome', 'asc')
            ->get();
    }

    protected function subcategorias(){
        return$this->hasMany(Subcategoria::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }

}
