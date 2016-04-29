<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = "contatos.contatos";

    protected $fillable = ['nome', 'email', 'descricao', 'foto', 'subcategoria_id', 'user_id'];

    protected function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

}
