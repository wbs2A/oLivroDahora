@extends('adminlte::page')

@section('title', 'Conversas')

@section('content_header')
    <h1>Amigos</h1>
@stop

@section('content')
<div class="container">
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
        </div>
    </div>
</div>

@stop
