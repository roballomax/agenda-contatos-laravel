<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Contato;
use App\Subcategoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ContatoController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('contatos.index', [
            'contatos' => Contato::lista_contatos_user(),
            'categorias' => Categoria::lista_todas_do_user_com_default()
        ]);
    }

    public function add(Request $request){

        $this->validate($request, [
           'nome' =>  'required|max:254',
           'email' => 'required|email|max:254',
           'categoria_id' => 'integer',
           'subcategoria_id' => 'integer'
        ]);

        $post_data = $request->all();

        Contato::create([
            'nome' => $post_data['nome'],
            'email' => $post_data['email'],
            'descricao' => (!empty($post_data['descricao']) ? $post_data['descricao'] : null),
            'user_id' => Auth::user()->id,
            'categoria_id' => (!empty($post_data['categoria_id']) ? $post_data['categoria_id'] : null),
            'subcategoria_id' => (!empty($post_data['subcategoria_id']) ? $post_data['subcategoria_id'] : null)
        ]);

        return back();
    }

    public function edit(Contato $contato){

        return view('contatos.edit', [
            'contato' => $contato,
            'categorias' => Categoria::lista_todas_do_user_com_default(),
            'subcategorias' => Subcategoria::lista_subcategorias($contato->categoria_id)
        ]);
    }

    public function update(Request $request, Contato $contato){

        $this->validate($request, [
            'nome' =>  'required|max:254',
            'email' => 'required|email|max:254',
            'categoria_id' => 'integer',
            'subcategoria_id' => 'integer'
        ]);

        $patch_data = $request->all();

        $contato->update([
            'nome' => $patch_data['nome'],
            'email' => $patch_data['email'],
            'categoria_id' => (!empty($patch_data['categoria_id']) ? $patch_data['categoria_id'] : null),
            'subcategoria_id' => (!empty($patch_data['subcategoria_id']) ? $patch_data['subcategoria_id'] : null),
            'descricao' => (!empty($patch_data['descricao']) ? $patch_data['descricao'] : null)
        ]);

        return redirect('/contatos');
    }

    public function delete(Contato $contato){
        Storage::disk('local')->delete('contatos/' . $contato->id . '.jpg');
        $contato->delete();
        return back();
    }

    public function imagem(Contato $contato){
        return view('contatos.imagem', [
            'contato' => $contato
        ]);
    }

    public function imagem_cadastrar(Request $request, Contato $contato){

        $this->validate($request, [
            'foto' => 'mimes:jpeg,jpg,png,gif',
        ]);

        $patch_data = $request->all();

        $contato->update([
            'foto' => '/image/contatos/'. $contato->id . '.jpg'
        ]);

        if($request->hasFile('foto')){
            $request->file('foto')->move('image/contatos/', $contato->id . '.jpg');
        }

        return back();
    }

    public function delete_imagem(Contato $contato){
        unlink('image/contatos/' . $contato->id . '.jpg');
        $contato->update([
            'foto' => null
        ]);
        return back();
    }

}
