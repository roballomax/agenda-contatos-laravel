<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contato extends Model
{
    protected $table = "contatos.contatos";

    protected $fillable = ['nome', 'email', 'descricao', 'foto', 'subcategoria_id', 'categoria_id', 'user_id', 'telefone'];

    protected static function lista_contatos_user($where = null){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        if(!is_null($where)){

            $wheres = [];
            if(!empty($where['categoria_id'])){
                $wheres['categoria_id'] = $where['categoria_id'];
            }
            if(!empty($where['subcategoria_id'])){
                $wheres['subcategoria_id'] = $where['subcategoria_id'];
            }

            return Contato::whereIn('user_id', $users)
                ->where('nome', 'ILIKE', '%' . $where['nome'] . '%')
                ->where('email', 'ILIKE', '%' . $where['email'] . '%')
                ->where('telefone', 'ILIKE', '%' . $where['telefone'] . '%')
                ->where($wheres)
                ->orderBy('nome', 'asc')
                ->get();
        } else {
            return Contato::whereIn('user_id', $users)
                ->orderBy('nome', 'asc')
                ->get();
        }
    }

    protected static function lista_contatos_user_index(){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return Contato::whereIn('user_id', $users)
            ->orderBy('nome', 'asc')
            ->limit(4)
            ->get();
    }

    public static function verifica_filiacao($contato_id){

        $users = [Auth::user()->id, Auth::user()->user_id];
        foreach(Auth::user()->users as $user){
            $users[] = $user->id;
        }

        return Contato::whereIn('user_id', $users)
            ->where('id', $contato_id)
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
