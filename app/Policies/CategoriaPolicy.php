<?php

namespace App\Policies;

use App\Http\Requests\Request;
use App\Permissao;
use App\Permissoes_user;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CategoriaPolicy
{
//    use HandlesAuthorization;
//
//    /**
//     * Create a new policy instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }

    public function before($user, $ability)
    {
        if (Auth::user()->adm) {

            return true;
        }
    }

    public function index($permissao_id){
        $permissionado = count(Permissoes_user::verifica_permissao(Auth::user()->id, $permissao_id));
        return ($permissionado == 1 ? false : true);
    }

}
