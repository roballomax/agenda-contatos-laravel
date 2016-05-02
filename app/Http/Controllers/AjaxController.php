<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Permissao;
use App\Subcategoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AjaxController extends Controller
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

    public function subcategorias_listar(Request $request){

        $post_data = $request->all();

        return Subcategoria::lista_subcategorias($post_data['categoria_id']);
    }
}
