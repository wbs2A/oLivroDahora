@extends('adminlte::page')

@section('title', 'Conversas')

@section('content_header')
    <h1>{{$friend->name}}</h1>
@stop

@section('content')
    <meta name="friendId" content="{{$friend->iduser}}">
    <meta name="userId" content="{{\Illuminate\Support\Facades\Auth::user()->iduser}}">
    <div class="container" id="app">
        <div class="column is-8 is-offset-2">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-offset-11">
                            <a href="{{url('/admin/chat')}}" class="is-link"><i class="fa fa-arrow-left"></i>Voltar</a>
                        </div>
                        <div class="col text-center h3">
                            Conversa com {{$friend->name}}
                        </div>
                    </div>
                    <chat v-bind:chats="chats"
                          v-bind:friendid="{{$friend->iduser}}"
                          v-bind:userid="{{Auth::user()->iduser}}"></chat>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('js/conversation.js')}}"></script>
@stop