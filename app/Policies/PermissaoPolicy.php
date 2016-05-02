<?php

namespace App\Policies;

use App\Permissao;
use App\Permissoes_user;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissaoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->adm) {
            return true;
        }
    }

    public function verificaPermissao(User $user, Permissao $permissao){
        $permissionado = count(Permissoes_user::verifica_permissao($user->id, $permissao->id));
        return ($permissionado == 1 ? false : true);
    }

    public function acessaUsers(User $user, Permissao $permissao){
        return $user->adm;
    }

}
