<?php

namespace App\Http\Controllers;

use App\Permissao;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mockery\CountValidator\Exception;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

        if(!is_null(Auth::user())){
            if (Auth::user()->cannot('acessaUsers', new Permissao())) {
                abort(403, "Acesso Negado");
            }
        }
    }

    public function index() {

        return view('users.index', [
            'users' => User::get_all_users_from_logged()
        ]);
    }

    public function add(Request $post){

        $this->validate($post, [
            'name' => 'required|max:254',
            'email' => 'required|max:254|email|unique:users',
            'password' => 'required|max:254|min:6|confirmed'
        ]);

        $post_data = $post->all();
        try {
            User::create([
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'password' => bcrypt($post_data['password']),
                'user_id' => Auth::user()->id,
                'adm' => false
            ]);

            flash_session("Cadastrado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Cadastrar :(", 'danger');
        }

        return back();

    }

    public function edit(User $user){
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $patch){

        $this->validate($patch, [
            'name' => 'required|max:254',
            'email' => 'required|max:254|email|unique:users,email,' . $user->id
        ]);

        try {
            $user->update($patch->all());

            flash_session("Atualizado com Sucesso :D");

        } catch (Exception $e){

            flash_session("Falha ao Atualizar :(", 'danger');
        }
        return redirect('/users');
    }

    public function delete(User $user){
        try {
            $user->delete();
            flash_session("Deletado com Sucesso :D");
        } catch (Exception $e){
            flash_session("Falha ao Deletar :(", 'danger');
        }
        return back();
    }

}
