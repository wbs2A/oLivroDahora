@extends('adminlte::page')

@section('title', 'Conversas')

@section('content_header')
    <h1>Amigos</h1>
@stop

@section('content')
<div class="container">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger"><i class="fa fa-times-circle"></i> {{$error}}</div>
        @endforeach
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul style="list-style: none">
                <li><i class="fa fa-star"></i> {!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="column is-8 is-offset-2">
        <div class="panel">
                <ul>
            @forelse($Friends as $friend)
                <li><a href="{{route('chat.show', $friend->iduser)}}" class="panel-block h3">
                    {{$friend->name}}
                </a></li>
            @empty
                <div class="panel-block">
                    <li>Você ainda não adicionou nenhum amigo.</li>
                </div>
            @endforelse
                </ul>
            <div class="float-left rounded-circle">
                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Adicionar amigo <i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar amigo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/api/addFriend" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Insira o nome do amigo</label><br>
                        <input name="nome" id="name" type="text"><br><br>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
