<?php

namespace App\Policies;

use App\Subcategoria;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcategoriaPolicy
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

    public function manageSubcategoria(User $user, Subcategoria $subcategoria){

        $filiacao = count(Subcategoria::verifica_filiacao($subcategoria->id));

        if($filiacao){
            return true;
        }

        return false;


    }

}
