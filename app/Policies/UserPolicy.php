<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function manageUser(User $user, User $user_filiado){

        $filiado = count(User::verifica_filiacao($user_filiado->id));

        if($filiado){
            return true;
        }

        return false;

    }
}
