<?php

namespace App\Http\Controllers;

use App\Permissao;
use App\Permissoes_user;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PermissaoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');

        $permissao = Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri());
        if(count($permissao) > 0){
            if (Auth::user()->cannot('verificaPermissao', $permissao[0])) {
                abort(403, "Acesso Negado");
            }
        }
    }

    public function index(User $user){

        return view('permissoes.index', [
            'user' => $user,
            'permissoes' => Permissao::all()
        ]);
    }

    public function add(Request $request, User $user){

        try {
            Permissoes_user::limpa_permissoes($user->id);

            foreach($request->all() as $permissao_id => $permissao_valor){

                if($permissao_valor == "false" && $permissao_id != "_token"){
                    Permissoes_user::create([
                        'user_id' => $user->id,
                        'permissao_id' => $permissao_id
                    ]);
                }
            }

            flash_session("Cadastradas com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }
        return redirect('/users');
    }

}
