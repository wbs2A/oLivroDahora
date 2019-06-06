@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Meus Posts</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            @forelse($Posts as $post)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    {{$post->titulo}}
                                </div>
                                <div class="col">
                                    <div class="text-right"><a class="btn" href="{{route('editPost', $post->idpost)}}"><i class="fa fa-edit"></i></a><a class="btn" href="{{route('removePost', $post->idpost)}}"><i class="fa fa-trash-o text-danger"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {!! $post->conteudo  !!}
                        </div>
                        <div class="panel-footer">
                            {{$post->datapostagem}}
                        </div>
                    </div>
                </div>
                @empty
                <h3> Você ainda não postou nada!</h3>
                <p>Clique <a href="/admin/createpost"> aqui <i class="fa fa-plus"></i> </a> para seu primeiro post.</p>
            @endforelse
        </div>
    </div>
@stop



