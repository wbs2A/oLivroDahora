@extends('adminlte::page')

@section('title', 'Posts sem  Livro')

@section('content_header')
    @if(isset($posts[0]) && count($posts[0]->livros()->get()) > 0)
        <h1>Posts com  Livro</h1>
    @else
        <h1>Posts sem  Livro</h1>
    @endif
@stop

@section('content')
<div class="container">
    <div class="row">
		@forelse($posts as $post)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    {{$post->titulo}}
                                </div>
                                <div class="col">
                                    <div class="text-right">
                                    	@if(count($post->livros()->get()) > 0)
                                    		<a class="btn" href="{{route('insertBook', $post->idpost)}}" ><i class="fa fa-address-book-o"></i> </a>
                                    	@else
											<a class="btn" href="{{route('insertBook', $post->idpost)}}"><i style="font-size: 7px" class="fa fa-plus"></i><i class="fa fa-address-book-o"></i></a>
                                    	@endif

    								</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col text-truncate">
                                {!! $post->conteudo  !!}
                            </div>
                        </div>
                        <div class="panel-footer">
                            {{$post->datapostagem}}
                        </div>
                    </div>
                </div>
    	@empty
    		<h1>Você nenhum post sem livro.</h1>
	@endforelse
    </div>
</div>
@stop