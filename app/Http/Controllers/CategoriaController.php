<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Permissao;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class CategoriaController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

        if(!is_null(Auth::user())) {
            $permissao = Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri());
            if (count($permissao) > 0) {
                if (Auth::user()->cannot('verificaPermissao', $permissao[0])) {
                    abort(403, "Acesso Negado");
                }
            }
        }

    }

    public function index(Request $request) {

        $categorias = Categoria::lista_todas_do_user_com_default();

        return view("categorias.index", [
            'categorias' => $categorias
        ]);
    }

    public function add(Request $post) {

        $this->validate($post, [
            'nome' => ['required', 'max:254'],
        ]);

        $post_data = $post->all();

        try {
            Categoria::create([
                'nome' => $post_data['nome'],
                'descricao' => $post_data['descricao'],
                'user_id' => Auth::user()->id
            ]);

            flash_session("Cadastrado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }


        return back();
    }

    public function delete(Categoria $categoria){
        try{

            if(Auth::user()->cannot('manageCategoria', $categoria)){
                flash_session("Falha ao Deletar :(", 'danger');
                return redirect("/categorias");
            }

            $categoria->delete();
            flash_session("Deletado com Sucesso :D");
        } catch (Exception $e){
            flash_session("Falha ao Deletar :(", 'danger');
        }

        return redirect("/categorias");
    }

    public function edit(Categoria $categoria){
        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    public function update(Request $patch, Categoria $categoria){

        if(Auth::user()->cannot('manageCategoria', $categoria)){
            flash_session("Falha ao Atualizar :(", 'danger');
            return redirect("/categorias");
        }

        $this->validate($patch, [
            'nome' => ['required', 'max:254'],
        ]);

        $patch_data = $patch->all();

        try{

            $categoria->update([
                'nome' => $patch_data['nome'],
                'descricao' => $patch_data['descricao']
            ]);
            flash_session("Atualizado com Sucesso :D");

        } catch (Exception $e){
            flash_session("Falha ao Atualizar :(", 'danger');
        }

        return redirect('/categorias');
    }
}
