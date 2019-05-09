@extends('master')
@section('content')
<div id="dashboard" class="container-fluid p-0">
	<div class="row m-1">
		<ul class="col-2 col-sm-2 col-md-2 p-0 nav flex-column nav-pills" id="pills-tab" role="tablist">
			<li class="nav-item">
	            <router-link :to="{name: 'home'}" class="nav-link active" id="pills-home-tab" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true"> Minha Conta</router-link>
	        </li>
			<li>
				<router-link :to="{name:'post'}" class="nav-link" id="pills-post-tab" data-toggle="pill" role="tab" aria-controls="pills-post" aria-selected="true"> Post </router-link>
			</li>
		</ul>
		<div class="col-10 m-0 p-0 tab-pane tab-content" id="pills-tabContent">
	        <router-view></router-view>
	    </div>
		
	</div>
	
</div>
<script src="js/app.js"></script>
<script src="js/dashboard.js"></script>
@stop