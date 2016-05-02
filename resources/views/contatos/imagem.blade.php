@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Imagem do contato - {{$contato->nome}} - <a href="{{url()->to("/contatos")}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/contatos/imagem/{{$contato->id}}" enctype="multipart/form-data">
                                {{method_field('PATCH')}}
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="foto">Foto:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto" id="foto" value="{{old('foto')}}">
                                    </div>
                                </div>
                                <div class="form-group col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar Foto +</button>
                                </div>
                            </form>
                        </div>
                        @if(file_exists(substr($contato->foto, 1, strlen($contato->foto))))
                            <a href="/contatos/imagem/{{$contato->id}}/delete">Excluir Imagem</a>
                            <div class="row">
                                <img src="{{$contato->foto}}" class="img-thumbnail" width="304" height="236" />
                            </div>
                        @endif
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
