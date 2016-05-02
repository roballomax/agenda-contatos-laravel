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
    }

    public function index(Request $request) {

//        if (Gate::denies('index', Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri())[0]->id)) {
//            abort(403);
//        }

        $categorias = Categoria::lista_todas_do_user();

        return view("categorias.index", [
            'categorias' => $categorias
        ]);
    }

    public function add(Request $post) {

        $this->validate($post, [
            'nome' => ['required', 'max:254'],
        ]);

        $post_data = $post->all();

        Categoria::create([
            'nome' => $post_data['nome'],
            'description' => $post_data['descricao'],
            'user_id' => Auth::user()->id
        ]);

        return back();
    }

    public function delete(Categoria $categoria){
        $categoria->delete();
        return back();
    }

    public function edit(Categoria $categoria){
        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    public function update(Request $patch, Categoria $categoria){

        $this->validate($patch, [
            'nome' => ['required', 'max:254'],
        ]);

        $patch_data = $patch->all();

        $categoria->update([
            'nome' => $patch_data['nome'],
            'descricao' => $patch_data['descricao']
        ]);

        return redirect('/categorias');
    }
}
