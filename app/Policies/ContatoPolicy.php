<?php

namespace App\Policies;

use App\Contato;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContatoPolicy
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

    public function manageContato(User $user, Contato $contato){
        $filiacao = count(Contato::verifica_filiacao($contato->id));

        if($filiacao){
            return true;
        }

        return false;

    }

}
