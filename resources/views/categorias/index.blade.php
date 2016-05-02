@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de Categoria</div>
                    <div class="panel-body">
                        @can('verificaPermissao', App\Permissao::pega_permissao_pela_url('categorias/add')[0])
                            <div class="row">
                                <form method="post" action="/categorias/add">
                                    {{csrf_field()}}
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="nome">Nome:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}" placeholder="Família...">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="descricao">Descroção:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Integrantes da família...">{{old('descricao')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                    </div>
                                </form>
                            </div>

                            @if(count($errors->all()) > 0)
                                <div class="row">
                                    <div class="list-group">
                                        @foreach($errors->all() as $error)
                                            <p class="list-group-item list-group-item-danger">{{$error}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-danger">
                                        Sem permissão para cadastrar categorias!
                                    </li>
                                </ul>
                            </div>
                        @endcan
                        @can('verificaPermissao', App\Permissao::pega_permissao_pela_url('categorias/todos')[0])
                            @if(!empty($categorias))
                                <div class="row">
                                    <div class="list-group">
                                        @foreach($categorias as $categoria)
                                            <p class="list-group-item">
                                                {{$categoria->nome}}
                                                <span class="pull-right">
                                                    <a href="/categorias/{{$categoria->id}}/edit">Editar</a> |
                                                    <a href="/subcategorias/{{$categoria->id}}">Subcategorias</a> |
                                                    <a href="/categorias/delete/{{$categoria->id}}">Deletar</a>
                                                </span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-danger">
                                        Sem permissão para ver as categorias!
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
