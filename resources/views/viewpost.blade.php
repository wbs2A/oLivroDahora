@extends('master')
@section('content') 
    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area relative">
        <div  class="container">
            <div class="row">
                <div id="post" class="col-lg-8"  style="padding-top: 15px;">
                    @if(Auth::check())
                        <div class="row">
                            <post :model="{{$post}}" :user="{{ $user}}"></post>
                        </div>
                        <div class="row">
                            <comment :comment-url="{{$post[0]['idpost']}}" :user="{{ $user}}"></comment>
                        </div>
                        @else
                            <div class="row">
                                <post :model="{{$post}}"></post>
                            </div>

                            <div class="row">
                                <comment :comment-url="{{$post[0]['idpost']}}"></comment>
                            </div>
                        @endif
                    <div class="row">
                    </div>
                </div>
                @include("static.postSidebar")

            </div>
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
    <script src='{{asset("js/post.js")}}'></script>
@stop