@extends('master')
@section('content')
<div id="carrinho" class="container">
	<view-carrinho :carrinho='@json($compra)' :checked="true" :fim="true"></view-carrinho>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset("js/carrinho.js")}}"></script>
@stop