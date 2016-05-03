@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Todos os contatos - <a href="{{url()->previous()}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row" style="padding: 10px;">
                            <form method="post" action="/contatos/todos ">
                                {{csrf_field()}}
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="form-group col-lg-3">
                                        <label for="nome">Nome:</label>
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{(!empty($post_data['nome']) ? $post_data['nome'] : '')}}" placeholder="Família...">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="email">E-mail:</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{(!empty($post_data['email']) ? $post_data['email'] : '')}}" placeholder="{{"meu.nome@exemplo.com"}}">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="email">Telefone:</label>
                                        <input type="tel" class="form-control" name="telefone" id="telefone" value="{{(!empty($post_data['telefone']) ? $post_data['telefone'] : '')}}" placeholder="{{"(48) 0000-0000"}}">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="form-group col-lg-3">
                                        <label for="categoria">Categoria:</label>
                                        <select name="categoria_id" id="categoria" class="form-control">
                                            <option value="">Selecione</option>
                                            @foreach($categorias as $key => $categoria)
                                                @if(!empty($post_data['categoria_id']))
                                                    <option value="{{$categoria->id}}" {{ ($post_data["categoria_id"] == $categoria->id ? "selected":"") }} >{{$categoria->nome}}</option>
                                                @else
                                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="subcategoria">Subcategoria:</label>
                                        <select name="subcategoria_id" id="subcategoria" class="form-control">
                                            <option value="">Selecione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3">
                                    <button type="submit" class="btn btn-info">Pesquisar</button>
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
                        @if(!empty($contatos))
                            <div class="row">
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-info">
                                        Lista de Contatos
                                    </div>
                                    @if(count($contatos) > 0)
                                        @foreach($contatos as $contato)
                                            <div class="list-group-item" style="overflow: hidden;">
                                                <a href="/contatos/ver_contato/{{$contato->id}}">
                                                    <div class="col-lg-8 pull-left">
                                                        @if(file_exists(substr($contato->foto, 1, strlen($contato->foto))))
                                                            <div class="col-lg-2">
                                                                <img src="{{$contato->foto}}" class="img-rounded pull-left" width="50" height="50" />
                                                            </div>
                                                        @endif
                                                        <div class="col-lg-10 center-block">
                                                            <p class="pull-left">{{$contato->nome}}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="col-lg-4 pull-left">
                                                    <span class="pull-right">
                                                        <a href="/contatos/imagem/{{$contato->id}}">Cadastrar Imagem</a> |
                                                        <a href="/contatos/{{$contato->id}}/edit">Editar</a> |
                                                        <a href="/contatos/delete/{{$contato->id}}">Deletar</a>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="list-group-item" style="overflow: hidden;">
                                            <p class="list-group-item list-group-item-danger">
                                                Nenhum Contato Encontrado :(
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection