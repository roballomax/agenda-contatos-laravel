<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contato extends Model
{
    protected $table = "contatos.contatos";

    protected $fillable = ['nome', 'email', 'descricao', 'foto', 'subcategoria_id', 'categoria_id', 'user_id'];

    protected static function lista_contatos_user(){
        return Contato::where('user_id', Auth::user()->id)
            ->orderBy('nome', 'asc')
            ->get();
    }

    protected static function busca_ultimo_id(){
        return Contato::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
    }

    protected function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }

    protected function categoria(){
        return $this->belongsTo(Categoria::class);
    }

}
