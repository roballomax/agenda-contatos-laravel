@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edição da contato - <a href="{{url()->to("/contatos")}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/contatos/update/{{$contato->id}}">
                                {{method_field('PATCH')}}
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="nome">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$contato->nome}}" placeholder="Família...">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="email">E-mail:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" value="{{$contato->email}}" placeholder="{{"meu.nome@exemplo.com"}}">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="categoria">Categoria:</label>
                                    <div class="col-sm-10">
                                        <select name="categoria_id" id="categoria" class="form-control">
                                            <option value="">Selecione</option>
                                            @foreach($categorias as $key => $categoria)
                                                @if($contato->categoria_id == $categoria->id)
                                                    <option value="{{$categoria->id}}" selected >{{$categoria->nome}}</option>
                                                @else
                                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="subcategoria">Subcategoria:</label>
                                    <div class="col-sm-10">
                                        <select name="subcategoria_id" id="subcategoria" class="form-control">
                                            <option value="">Selecione</option>
                                            @if(!empty($subcategorias))
                                                @foreach($subcategorias as $key => $subcategoria)
                                                    @if($contato->subcategoria_id == $subcategoria->id)
                                                        <option value="{{$subcategoria->id}}" selected >{{$subcategoria->nome}}</option>
                                                    @else
                                                        <option value="{{$subcategoria->id}}">{{$subcategoria->nome}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="descricao">Descrição:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Irmão da fulana...">{{$contato->descricao}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Editar</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
