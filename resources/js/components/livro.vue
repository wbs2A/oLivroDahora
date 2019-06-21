<template>
<div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">{{livro.nome}}</h5>
    <div class="row">

    	<div class="col-2  p-0 m-0">
    		<img class="col p-0 m-0" :src="'/storage/'+livro.imagem.filename">
    	</div>
    	<div class="col-4 p-0 m-0">
    		<span><strong>Ano: </strong>{{ year(livro.ano)}}</span>
    		<br>
    		<a >ver descrição</a>	
    	</div>
    	<div  class="col-4 p-0 m-0 text-center">
    		<h3> R$ {{livro.valor}}</h3>
    			<a @click="addCarrinho(livro.idlivro, livro.valor)" class="btn btn-danger p-1" style="color: white">Adicionar no carrinho</a>
    	</div>
    </div>
    <!--  -->
  </div>
  <div class="card-footer text-muted">
  </div>
</div>
</template>
<script>
export default {
	props:['livro'],
	methods: {
		year(value){
			return (new Date(value +" 00:00:00")).getFullYear();
		},
		addCarrinho(id, valor){
			console.log(id);
			axios.post('/api/carrinho/', {
                livro_idlivro : id,
                valor: valor
            }).then(
                res => {
                    console.log(res.data);
                    if (res.data.status) {
                    	axios.get('/api/carrinho').then(res =>{
                    		if(res.data.status){
                    			$("#checkout_items").text(res.data.compra.length);
                			}else{
                    			$("#checkout_items").text(0);
                			}             
                    	});
                    }
               	},
                (error) => {
                    console.log(error);
            });
		}
	}
}
</script>