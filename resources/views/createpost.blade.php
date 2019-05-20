@extends('master')
@section('content')
    <div class="blog-post-area relative" style="display: block">
        @if(isset($post))
            <edit-post :model='@json($post)'></edit-post>
        @else
            <create-post></create-post>
        @endif
    </div>
    <script src='{{asset('js/index.js')}}'></script>
@stop