<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = "contatos.contatos";

    protected function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

}
