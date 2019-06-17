@extends('adminlte::page')

@section('title', 'Inserir Livro')

@section('content_header')
    <h1>Inserir Livro</h1>
@stop

@section('content')
@forelse($posts as $post)
    {{$post->idpost }}
        {{$post->livros()->get()}}
    @empty
    <h1>Você ainda não inseriu nenhum post.</h1>
@endforelse
@stop