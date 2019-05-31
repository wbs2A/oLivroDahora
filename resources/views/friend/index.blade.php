@extends('adminlte::page')

@section('title', 'Conversas')

@section('content_header')
    <h1>Amigos</h1>
@stop

@section('content')
<div class="container">
    <div class="column is-8 is-offset-2">
        <div class="panel">
            <div class="panel-heading">
                Amigos:
            </div>
            @forelse($Friends as $friend)
                <a href="{{route('chat.show', $friend->iduser)}}" class="panel-block h3">
                    {{$friend->name}}
                </a>
            @empty
                <div class="panel-block">
                    Você ainda não adicionou nenhum amigo.
                </div>
            @endforelse
        </div>
    </div>
</div>

@stop
