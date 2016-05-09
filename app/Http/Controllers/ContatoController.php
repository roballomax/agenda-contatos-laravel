<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Contato;
use App\Permissao;
use App\Subcategoria;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ContatoController extends Controller
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

    public function index() {
        return view('contatos.index', [
            'contatos' => Contato::lista_contatos_user_index(),
            'categorias' => Categoria::lista_todas_do_user_com_default()
        ]);
    }

    public function add(Request $request){

        $this->validate($request, [
           'nome' =>  'required|max:254',
           'email' => 'email|max:254',
           'telefone' => 'required|max:254',
           'categoria_id' => 'integer',
           'subcategoria_id' => 'integer'
        ]);

        $post_data = $request->all();

        try {
            Contato::create([
                'nome' => $post_data['nome'],
                'email' => $post_data['email'],
                'telefone' => $post_data['telefone'],
                'descricao' => (!empty($post_data['descricao']) ? $post_data['descricao'] : null),
                'user_id' => Auth::user()->id,
                'categoria_id' => (!empty($post_data['categoria_id']) ? $post_data['categoria_id'] : null),
                'subcategoria_id' => (!empty($post_data['subcategoria_id']) ? $post_data['subcategoria_id'] : null)
            ]);
            flash_session("Cadastrado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }
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
            'telefone' =>  'required|max:254',
            'email' => 'email|max:254',
            'categoria_id' => 'integer',
            'subcategoria_id' => 'integer'
        ]);

        $patch_data = $request->all();
        try {

            if(User::user()->cannot('manageContato', $contato)){

                flash_session("Falha ao Atualizar :(", 'danger');
                return redirect("/contatos");
            }

            $contato->update([
                'nome' => $patch_data['nome'],
                'email' => $patch_data['email'],
                'telefone' => $patch_data['telefone'],
                'categoria_id' => (!empty($patch_data['categoria_id']) ? $patch_data['categoria_id'] : null),
                'subcategoria_id' => (!empty($patch_data['subcategoria_id']) ? $patch_data['subcategoria_id'] : null),
                'descricao' => (!empty($patch_data['descricao']) ? $patch_data['descricao'] : null)
            ]);
            flash_session("Atualizado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Atualizar :(", 'danger');
        }
        return redirect('/contatos');
    }

    public function delete(Contato $contato){
        try{

            if(Auth::user()->cannot('manageContato', $contato)){

                flash_session("Falha ao Deletar :(", 'danger');
                return redirect("/contatos");
            }

            Storage::disk('local')->delete('contatos/' . $contato->id . '.jpg');
            $contato->delete();
            flash_session("Deletado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Deletar :(", 'danger');
        }
        return back();
    }

    public function imagem(Contato $contato){
        return view('contatos.imagem', [
            'contato' => $contato
        ]);
    }

    public function imagem_cadastrar(Request $request, Contato $contato){

        $this->validate($request, [
            'foto' => 'mimes:jpeg,jpg,png,gif|required',
        ]);

        $patch_data = $request->all();

        try {

            if(Auth::user()->cannot('manageContato', $contato)){

                flash_session("Falha ao Cadastrar :(", 'danger');
                return redirect("/contatos");
            }

            $contato->update([
                'foto' => '/image/contatos/'. $contato->id . '.jpg'
            ]);

            if($request->hasFile('foto')){
                $request->file('foto')->move('image/contatos/', $contato->id . '.jpg');
            }

            flash_session("Cadastrada com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }
        return back();
    }

    public function delete_imagem(Contato $contato){
        try {

            if(Auth::user()->cannot('manageContato', $contato)){

                flash_session("Falha ao Deletar :(", 'danger');
                return redirect("/contatos");
            }

            unlink('image/contatos/' . $contato->id . '.jpg');
            $contato->update([
                'foto' => null
            ]);
            flash_session("Deletada com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Deletar :(", 'danger');
        }
        return back();
    }

    public function mostra_contato(Contato $contato){
        return view('contatos.contato', [
            'contato' => $contato
        ]);
    }

    public function all(Request $request){

        if($request->method() == "POST"){
            $this->validate($request, [
                'nome' =>  'max:254',
                'email' => 'email|max:254',
                'telefone' => 'max:254',
                'categoria_id' => 'integer',
                'subcategoria_id' => 'integer'
            ]);

            $post_data = $request->all();

            $contatos = Contato::lista_contatos_user($post_data);

        } else {
            $contatos = Contato::lista_contatos_user();
            $post_data = [];
        }

        return view('contatos.todos', [
            'contatos' => $contatos,
            'categorias' => Categoria::lista_todas_do_user_com_default(),
            'post_data' => $post_data
        ]);
    }

}
