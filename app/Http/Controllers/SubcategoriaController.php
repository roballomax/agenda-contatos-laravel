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

        $permissao = Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri());
        if(count($permissao) > 0){
            if (Auth::user()->cannot('verificaPermissao', $permissao[0])) {
                abort(403, "Acesso Negado");
            }
        }

    }

    public function index(Categoria $categoria){

//        if($categoria->user_id != Auth::user()->id)
//            return back();

        return view('subcategorias.index', [
            "categoria" => $categoria
        ]);
    }

    public function add(Request $post, $categoria_id){

        $this->validate($post, [
            'nome' => 'required|max:254'
        ]);

        $post_data = $post->all();

        Subcategoria::create([
            'nome' => $post_data['nome'],
            'categoria_id' => $categoria_id,
            'user_id' => Auth::user()->id   
        ]);

        return back();

    }

    public function edit(Subcategoria $subcategoria) {

        return view('subcategorias.edit', [
            'subcategoria' => $subcategoria
        ]);

    }

    public function update(Request $patch, Subcategoria $subcategoria ){

        $this->validate($patch, [
            'nome' => 'required|max:254'
        ]);

        $subcategoria->update($patch->all());

        return redirect('/subcategorias/' . $subcategoria->categoria->id);
    }

    public function delete(Subcategoria $subcategoria){

        $subcategoria->delete();
        return back();

    }

}
