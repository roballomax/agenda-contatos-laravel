<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Permissoes_user extends Model
{
    protected $table = "permissoes.permissoes_users";

    protected $fillable = ['user_id', 'permissao_id'];

    public static function limpa_permissoes($user_id){
        return Permissoes_user::where('user_id', $user_id)
            ->delete();
    }

    public static function verifica_permissao($user_id, $permissao_id){
        return Permissoes_user::where('user_id', $user_id)
            ->where('permissao_id', $permissao_id)
            ->limit(1)
            ->get();
    }

    protected function permission(){
        return $this->belongsTo(Permissao::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }

}
