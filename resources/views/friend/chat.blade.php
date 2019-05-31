@extends('adminlte::page')

@section('title', 'Conversas')

@section('content_header')
    <h1>{{$friend->name}}</h1>
@stop

@section('content')

    <div class="container">
        <div class="column is-8 is-offset-2">
            <div class="panel">
                <div class="panel-heading">
                    Conversa com {{$friend->name}}
                </div>
                <div class="contain is-pulled-right">
                    <a href="{{url('/admin/chat')}}" class="is-link"><i class="fa fa-arrow-left"></i>Voltar</a>
                </div>
            </div>
        </div>
    </div>
@stop