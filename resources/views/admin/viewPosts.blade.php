@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Meus Posts</h1>
@stop

@section('content')
@foreach($Posts as $post)
    {{$post}}
@endforeach
@stop

