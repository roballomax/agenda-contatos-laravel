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

    protected static function lista_todas_do_user_com_default(){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return Categoria::whereIn('user_id', $users)
            ->orderBy('nome', 'asc')
            ->get();
    }

    protected static function verifica_filiacao($categoria_id){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return Categoria::whereIn('user_id', $users)
            ->where('id', $categoria_id)
            ->limit(1)
            ->get();
    }

    protected function subcategorias(){
        return $this->hasMany(Subcategoria::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }

}
