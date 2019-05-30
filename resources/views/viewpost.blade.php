@extends('master')
@section('content') 
    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area relative">
        <div id="post" class="container">
            <div class="row">
                <div class="col-lg-8"  style="padding-top: 15px;">
                    <div class="row">
                        <post :model="{{$post}}"></post>
                    </div>
                    <div class="row">
                        @if(Auth::check())
                            <comment :comment-url="{{$post[0]['idpost']}}" :user="{{ $user}}"></comment>
                        @else
                            <comment :comment-url="{{$post[0]['idpost']}}"></comment>
                        @endif
                    </div>
                </div>

                @include("static.postSidebar")

            </div>
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
    <script src='{{asset("js/post.js")}}'></script>
@stop