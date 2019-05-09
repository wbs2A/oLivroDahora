@extends('master')
@section('content')
    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-8"  style="padding-top: 15px;">
                    <div class="row">
                        <post :model="{{$post}}"></post>
                    </div>
                </div>

                @include("static.postSidebar")

            </div>
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
    <script src='{{asset("js/index.js")}}'></script>
@stop