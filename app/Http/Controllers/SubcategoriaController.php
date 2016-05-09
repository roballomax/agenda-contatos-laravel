<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Permissao;
use App\Subcategoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SubcategoriaController extends Controller
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

    public function index(Categoria $categoria){

        if(Auth::user()->cannot('manageCategoria', $categoria)){
            flash_session("Falha ao Listar :(", 'danger');
            return redirect('/categorias');
        }

        return view('subcategorias.index', [
            "categoria" => $categoria
        ]);
    }

    public function add(Request $post, $categoria_id){

        $this->validate($post, [
            'nome' => 'required|max:254'
        ]);

        $post_data = $post->all();

        try{
            Subcategoria::create([
                'nome' => $post_data['nome'],
                'categoria_id' => $categoria_id,
                'user_id' => Auth::user()->id
            ]);

            flash_session("Cadastrado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }

        return back();

    }

    public function edit(Subcategoria $subcategoria) {

        if(Auth::user()->cannot('manageSubcategoria', $subcategoria)){
            flash_session("Falha ao Abrir Página :(", 'danger');
            return redirect('/categorias');
        }

        return view('subcategorias.edit', [
            'subcategoria' => $subcategoria
        ]);

    }

    public function update(Request $patch, Subcategoria $subcategoria ){

        $this->validate($patch, [
            'nome' => 'required|max:254'
        ]);

        try{

            if(Auth::user()->cannot('manageSubcategoria', $subcategoria)){
                flash_session("Falha ao Atualizar :(", 'danger');
                return redirect('/categorias');
            }

            $subcategoria->update($patch->all());

            flash_session("Atualizado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Atualizar :(", 'danger');
        }

        return redirect('/subcategorias/' . $subcategoria->categoria->id);
    }

    public function delete(Subcategoria $subcategoria){

        try {

            if(Auth::user()->cannot('manageSubcategoria', $subcategoria)){
                flash_session("Falha ao Deletar :(", 'danger');
                return redirect('/subcategorias/' . $subcategoria->categoria->id);
            }

            $subcategoria->delete();
            flash_session("Deletado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Deletar :(", 'danger');
        }
        return back();

    }

}
