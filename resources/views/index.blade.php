@extends('master')
@section('content')
<section class="blog-post-area relative">
    <div  class="container">
        <div class="row">
            <div id="index" class="col-lg-8" style="padding-top: 15px;">
                <div class="row">
                    <div class="col-lg-6 col-md-6" v-for="p in posts.data">
                        <post-component v-if="p" :model="p"></post-component>
                        
                    </div>
                </div>
                <vue-pagination  
                    :pagination='@json($post)'
                    :posts="posts"
                    @paginate="getPosts"
                    @mypost="setPosts"
                    :offset="1">
                </vue-pagination>
            </div>
            
            @include("static.postSidebar")

        </div>
    </div>
</section>
<script src='js/botwidget.js'></script>
<script src='js/index.js'></script>
@stop