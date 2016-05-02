<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contato extends Model
{
    protected $table = "contatos.contatos";

    protected $fillable = ['nome', 'email', 'descricao', 'foto', 'subcategoria_id', 'categoria_id', 'user_id', 'telefone'];

    protected static function lista_contatos_user($where = null){

        if(!is_null($where)){

            $wheres = [];
            if(!empty($where['categoria_id'])){
                $wheres['categoria_id'] = $where['categoria_id'];
            }
            if(!empty($where['subcategoria_id'])){
                $wheres['subcategoria_id'] = $where['subcategoria_id'];
            }


            return Contato::whereIn('user_id', [Auth::user()->id, Auth::user()->user_id])
                ->where('nome', 'ILIKE', '%' . $where['nome'] . '%')
                ->where('email', 'ILIKE', '%' . $where['email'] . '%')
                ->where('telefone', 'ILIKE', '%' . $where['telefone'] . '%')
                ->where($wheres)
                ->orderBy('nome', 'asc')
                ->get();
        } else {
            return Contato::whereIn('user_id', [Auth::user()->id, Auth::user()->user_id])
                ->orderBy('nome', 'asc')
                ->get();
        }
    }

    protected static function lista_contatos_user_index(){
        return Contato::whereIn('user_id', [Auth::user()->id, Auth::user()->user_id])
            ->orderBy('nome', 'asc')
            ->limit(4)
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
