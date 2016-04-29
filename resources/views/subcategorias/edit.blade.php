@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edição da Subcategoria - <a href="{{url()->to("/subcategorias/" . $subcategoria->categoria->id)}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/subcategorias/update/{{$subcategoria->id}}">
                                {{method_field('PATCH')}}
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="nome">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$subcategoria->nome}}" placeholder="Família...">
                                    </div>
                                </div>
                                <div class="form-group col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Atualizar</button>
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
