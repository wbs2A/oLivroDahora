@extends('master')
@section('content')
<!--================ Start Blog Post Area =================-->
<section class="blog-post-area relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($post as $p)
                        <post-component :model="{{$p}}"></post-component>
                    @endforeach
                </div>
            </div>

            @include("static.postSidebar")

        </div>
    </div>
</section>
<!--================ End Blog Post Area =================-->
<script src='js/botwidget.js'></script>
<script src='js/index.js'></script>
@stop