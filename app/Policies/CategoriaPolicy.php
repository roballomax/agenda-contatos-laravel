<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Categoria;

class CategoriaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manageCategoria(User $user, Categoria $categoria){

        $filiacao = count(Categoria::verifica_filiacao($categoria->id));
        if($filiacao){
            return true;
        }

        return false;

    }

}
