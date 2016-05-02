@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Contato - {{$contato->nome}} - <a href="{{url()->to("/contatos")}}">Voltar</a></div>
                    <div class="panel-body">
                            <div class="row">
                                @if(file_exists(substr($contato->foto, 1, strlen($contato->foto))))
                                    <div class="col-lg-4 pull-left">
    {{--                                    <img src="{{$contato->foto}}" class="img-circle" alt="Cinque Terre" width="304" height="236">--}}
                                        <img src="{{$contato->foto}}" class="img-thumbnail" width="304" height="236" />
                                    </div>
                                @endif
                                <div class="col-lg-8 pull-left">
                                    <ul class="list-group">
                                        <li class="list-group-item"><b>Nome:</b> {{$contato->nome}}</li>
                                        <li class="list-group-item"><b>Email:</b> {{$contato->email}}</li>
                                        <li class="list-group-item"><b>Telefone:</b> {{$contato->telefone}}</li>
                                        <li class="list-group-item"><b>Categoria:</b> {{$contato->categoria->nome}}</li>
                                        <li class="list-group-item"><b>Subcategoria:</b> {{$contato->subcategoria->nome}}</li>
                                        <li class="list-group-item">{{$contato->descricao}}</li>
                                    </ul>
                                </div>
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
