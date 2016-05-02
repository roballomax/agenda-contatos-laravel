@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de Contato</div>
                    <div class="panel-body">
                        @can('verificaPermissao', App\Permissao::pega_permissao_pela_url('contatos/add')[0])
                            <div class="row">
                                <form method="post" action="/contatos/add">
                                    {{csrf_field()}}
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="nome">Nome:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}" placeholder="Família...">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="email">E-mail:</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="{{"meu.nome@exemplo.com"}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="email">Telefone:</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" name="telefone" id="telefone" value="{{old('telefone')}}" placeholder="{{"(48) 0000-0000"}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="categoria">Categoria:</label>
                                        <div class="col-sm-10">
                                            <select name="categoria_id" id="categoria" class="form-control">
                                                <option value="">Selecione</option>
                                                @foreach($categorias as $key => $categoria)
                                                    <option value="{{$categoria->id}}" {{ (old("categoria_id") == $categoria->id ? "selected":"") }} >{{$categoria->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="subcategoria">Subcategoria:</label>
                                        <div class="col-sm-10">
                                            <select name="subcategoria_id" id="subcategoria" class="form-control">
                                                <option value="">Selecione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <label class="control-label col-sm-2" for="descricao">Descrição:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Irmão da fulana...">{{old('descricao')}}</textarea>
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
                                        Sem permissão para cadastrar contatos!
                                    </li>
                                </ul>
                            </div>
                            @endcan
                        @can('verificaPermissao', App\Permissao::pega_permissao_pela_url('contatos/todos')[0])
                            @if(!empty($contatos))
                                <div class="row">
                                    <div class="list-group">
                                        <a href="/contatos/todos" class="list-group-item list-group-item-info">Ver Todos</a>
                                        @foreach($contatos as $contato)
                                            <p class="list-group-item">
                                                <a href="/contatos/ver_contato/{{$contato->id}}">{{$contato->nome}}</a>
                                                <span class="pull-right">
                                                    <a href="/contatos/imagem/{{$contato->id}}">Cadastrar Imagem</a> |
                                                    <a href="/contatos/{{$contato->id}}/edit">Editar</a> |
                                                    <a href="/contatos/delete/{{$contato->id}}">Deletar</a>
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
                                        Sem permissão para ver os contatos!
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