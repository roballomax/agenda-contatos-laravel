<?php

namespace App\Http\Controllers;

use App\Permissao;
use App\Permissoes_user;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PermissaoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(User $user){

        return view('permissoes.index', [
            'user' => $user,
            'permissoes' => Permissao::all()
        ]);
    }

    public function add(Request $request, User $user){

        Permissoes_user::limpa_permissoes($user->id);

        foreach($request->all() as $permissao_id => $permissao_valor){

            if($permissao_valor == "false" && $permissao_id != "_token"){
                Permissoes_user::create([
                    'user_id' => $user->id,
                    'permissao_id' => $permissao_id
                ]);
            }
        }

        return redirect('/users');
    }

}
