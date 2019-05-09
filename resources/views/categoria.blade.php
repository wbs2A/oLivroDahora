@extends('master')
@section('content')
<div id='categoria' class="container-fluid">
	<categoria :mycategoria="{{$categoria}}" :mypost="{{$post}}" ></categoria>
</div>
<script type="text/javascript" src="js/categoria.js"></script>
@stop