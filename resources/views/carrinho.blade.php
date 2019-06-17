@extends('master')
@section('content')
<div id="carrinho">
	@if(Auth::check() && !(empty($compra)) && (count($compra) > 0))
	<table class='table table-striped table-bordered'>
		<thead>
	            <tr>
	          <th scope="col"></th>
	          <th scope="col">Nome</th>
	          <th scope="col">Descrição</th>
	          <th scope="col">Valor</th>
	          <th scope="col">Remover <br>produto</th>
	        </tr>
	      </thead>
	      <tbody>
	      	@foreach ($compra as $c)
		      	<tr>
		            <td>
			           <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			                <div class="carousel-inner">
			                	@if ($loop->first)
				                	<div class="carousel-item">
				                        <img class="d-block w-80" style="height:10vw;" src="" alt="First slide">
				                    </div>
				                @else
				                	<div class="carousel-item active">
		                                <img class="d-block w-80" style="height:10vw;" src="" alt="First slide">
		                            </div>
				                @endif
				        	</div>
		            	</div>
	    		</td>
	            <td>{{$c}}</td>
	            <td></td>
	            <td></td>
	            <td>
	            	<button @click="deleteCompra({{$c->idcompra}})" class="btn btn-danger">X</button>
	            </td>

	        </tr>
	    
			@endforeach
			</tbody>
	</table>
	@else
		<p>Você não possui itens no carrinho</p>
	@endif
</div>
<script src="js/compra.js"></script>
@stop