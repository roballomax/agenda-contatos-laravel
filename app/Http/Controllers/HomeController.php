<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $permissao = Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri());
        if(count($permissao) > 0){
            if (Auth::user()->cannot('verificaPermissao', $permissao[0])) {
                abort(403, "Acesso Negado");
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        flash_session("Meu pastel é mais barato!", 'info');

        return view('home');
    }
}
