@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de Usuários</div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/users/add">
                                {{csrf_field()}}
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="name">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="João da Silva...">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="email">E-mail:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="{{"seu.nome@exemplo.com..."}}">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="password">Senha:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label col-sm-2" for="password_confirmation">Confirmar:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="********">
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

                        @if(!empty($users))
                            <div class="row">
                                <div class="list-group">
                                    @foreach($users as $user)
                                        <p class="list-group-item">
                                            {{$user->name}} | {{$user->email}}
                                            <span class="pull-right">
                                                <a href="/users/{{$user->id}}/edit">Editar</a> |
                                                <a href="/users/delete/{{$user->id}}">Deletar</a> |
                                                <a href="/permissoes/{{$user->id}}">Permissões</a>
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
