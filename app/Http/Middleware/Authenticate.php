<?php

namespace App\Http\Middleware;

use App\Permissao;
use App\Permissoes_user;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

//        if(!Auth::user()->adm){
//            $permissao = Permissao::pega_permissao_pela_url(Route::getFacadeRoot()->current()->uri());
//            if(count($permissao) > 0){
//                $acesso_negado = count(Permissoes_user::verifica_permissao(Auth::user()->id, $permissao[0]->id));
//                if($acesso_negado == 1)
//                    abort(403);
//
//            }
//        }

        return $next($request);
    }
}
