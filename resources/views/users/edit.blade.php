@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edição de usuário - <a href="{{url()->to("/users")}}">Voltar</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/users/update/{{$user->id}}">
                                {{method_field('PATCH')}}
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="name">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="João da Silva...">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="email">E-mail:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="{{"seu.nome@exemplo.com..."}}">
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
