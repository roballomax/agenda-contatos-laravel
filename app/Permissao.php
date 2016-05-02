<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{

    protected $table = "permissoes.permissoes";

    protected $fillable = ['nome', 'url', 'descricao'];

    public static function pega_permissao_pela_url($url){
        return Permissao::where('url', $url)
            ->limit(1)
            ->get();
    }

    protected function permissoes_users(){
        return $this->hasMany(Permissoes_user::class);
    }


}
