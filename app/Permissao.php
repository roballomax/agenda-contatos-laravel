<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{

    protected $table = "permissoes.permissoes";

    protected function permissoes_users(){
        return $this->hasMany(Permissoes_user::class);
    }


}
