<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Subcategoria;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function subcategorias_listar(Request $request){

        $post_data = $request->all();

        return Subcategoria::lista_subcategorias($post_data['categoria_id']);
    }
}
