<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subcategoria extends Model
{
    protected $table = "categorias.subcategorias";

    protected $fillable = ['nome', 'categoria_id', 'user_id'];

//    protected static function lista_subcategorias_user($categoria_id){
//        return Subcategoria::where('categoria_id', $categoria_id)
//            ->whereIn('user_id', [1, Auth::user()->id])
//            ->orderBy('nome', 'asc')
//            ->get();
//    }

    protected static function lista_subcategorias($categoria_id){
        return Subcategoria::where('categoria_id', $categoria_id)
            ->orderBy('nome', 'asc')
            ->get();
    }

    public static function verifica_filiacao($subcategoria_id){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return Subcategoria::whereIn('user_id', $users)
            ->where('id', $subcategoria_id)
            ->limit(1)
            ->get();
    }

    protected function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    protected function user(){
        return $this->belongsTo(\Illuminate\Foundation\Auth\User::class);
    }
}
