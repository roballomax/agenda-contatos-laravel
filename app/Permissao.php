<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissao extends Model
{

    protected $table = "permissoes.permissoes";

    protected $fillable = ['nome', 'url', 'descricao'];

    public static function lista_permissoes($user_id){
        $sql = "SELECT
                  id,
                  nome,
                  descricao,
                  (SELECT count(*) FROM permissoes.permissoes_users WHERE permissoes.permissoes_users.user_id = :user_id AND permissoes.permissoes_users.permissao_id = permissoes.permissoes.id ) AS selected
                FROM
                  permissoes.permissoes
                ORDER BY
                    id";

        return DB::select($sql,['user_id' => $user_id] );
//        return DB::connection()->getPdo()->select($sql);

    }

    public static function pega_permissao_pela_url($url){
        return Permissao::where('url', $url)
            ->limit(1)
            ->get();
    }

    protected function permissoes_users(){
        return $this->hasMany(Permissoes_user::class);
    }


}
