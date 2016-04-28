<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissoes_user extends Model
{
    protected $table = "permissoes.permissoes_users";

    protected function permission(){
        return $this->belongsTo(Permissao::class);
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }

}
