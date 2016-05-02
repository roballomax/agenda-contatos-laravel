@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de Contato</div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="/permissoes/add/{{$user->id}}">
                                {{csrf_field()}}
                                @foreach($permissoes as $permissao)
                                    <div class="form-group col-sm-10" title="{{$permissao->descricao}}">
                                        <label class="control-label col-sm-2" for="{{$permissao->id}}">{{$permissao->nome}}</label>
                                        <div class="col-sm-10">
                                            <select name="{{$permissao->id}}" class="form-control" id="{{$permissao->id}}">
                                                <option value="true">TRUE</option>
                                                <option value="false" {{($permissao->selected ? 'selected' : '')}}>FALSE</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
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