@extends('adminlte::page')

@section('title', 'Inserir Livro')

@section('content_header')
    <h1>Inserir Livro</h1>
@stop

@section('content')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-10 col-xs-offset-1">

                <div class="card">
                    <form id="createPost" enctype="multipart/form-data" action="{{route($a, $post)}}" method="post" >
                        <div class="form-group">
                            <div class="col">
                                <label for="title">Insira o nome do Livro</label>
                                <input class="form-control" id="nome" name="nome" value="@isset($livro){{$livro->nome}}@endisset" max="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="img">Insira a imagem do Livro</label>
                                <br>
                                <update-imagem ref="modal" @isset($livro) :src="{{$livro}}" @endisset :legenda="'Imagem'" :cla="'fa fa-file-image-o icon'" :size="'50'"></update-imagem>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="descricao">Insira a descrição</label>
                                <input value="@isset($livro) {{$livro->descricao}} @endisset" class="form-control" id="descricao" name="descricao" max="40">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="categoria">Insira o valor do livro:</label>
                                <input class="form-control" id="valor" value="@isset($livro){{$livro->valor}}@endisset" step="0.01" type="number" name="valor">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="categoria">Insira o peso do livro:</label>
                                <input class="form-control" id="peso" type="text" name="peso" value="@isset($livro){{$livro->peso}}@endisset">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="categoria">Insira o ano do livro:</label>
                                <input class="form-control" value="@isset($livro){{$livro->ano}}@endisset" id="ano" type="number" name="ano">
                            </div>
                        </div>
                            {{csrf_field()}}
                            <button class="form-control" type="submit">Enviar</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('js/createPost.js')}}"></script>
@stop