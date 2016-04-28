@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="row">
                        <ul class="list-group">
                            <a href="/contatos"><li class="list-group-item">Gerenciar Contatos</li></a>
                            <a href="/categorias"><li class="list-group-item">Gerenciar Categorias</li></a>
                            <a href="/users"><li class="list-group-item ">Gerenciar Usuários</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
