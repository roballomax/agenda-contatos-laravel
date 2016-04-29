@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de Subcategoria - <a href="{{url()->to('/categorias')}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/subcategorias/add/{{$categoria->id}}">
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="nome">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}" placeholder="Irmãos...">
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

                        @if(count($categoria->subcategorias) > 0)
                            <div class="row">
                                <div class="list-group">
                                    @foreach($categoria->subcategorias as $subcategoria)
                                        <p class="list-group-item">
                                            {{$subcategoria->nome}}
                                            <span class="pull-right">
                                                <a href="/subcategorias/{{$subcategoria->id}}/edit">Editar</a> |
                                                <a href="/subcategorias/delete/{{$subcategoria->id}}">Deletar</a>
                                            </span>
                                        </p>
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
