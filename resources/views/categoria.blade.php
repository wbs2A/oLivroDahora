@extends('master')
@section('content')
<div id='categoria' class="container-fluid">
	<div class="row">
		<div class="col-3 col-sm-3 col-md-3  p-0 sidebar-widgets">
		    <div class="widget-wrap">
		        <div class="single-sidebar-widget search-widget">
					    <div class="container single-sidebar-widget post-category-widget">
			            <h4 class="category-title">Categorias</h4>
			            <categoria 
			            v-on:click="setCategoria" :cate="{{$categoria}}"></categoria>
			        </div>
				    </div>
			</div>
		</div>
    	<div class="col-8 col-sm-8 col-md-8  p-0">
    		<div class="row">
                <div class="col-lg-6 col-md-6" v-for="p in posts.data">
                    <post-component v-if="p" :model="p"></post-component>
                </div>
            </div>
            <vue-pagination :pagination='@json($post)'
                    :posts="posts"
                    @paginate="getPosts"
                    @mypost="setPosts"
                :offset="1">
    	</vue-pagination>
    	</div>
    </div>
</div>
<script type="text/javascript" src="js/categoria.js"></script>
@stop