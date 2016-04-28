@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="list-group">
                            <a href="/contatos" class="list-group-item">Gerenciar Contatos</a>
                            <a href="/categorias" class="list-group-item">Gerenciar Categorias</a>
                            <a href="/users" class="list-group-item">Gerenciar Usuários</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
