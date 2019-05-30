<template>
	<div class="row">
		<div class="col-3 col-sm-3 col-md-3  p-0 sidebar-widgets">
		    <div class="widget-wrap">
		        <div class="single-sidebar-widget search-widget">
					    <div class="container single-sidebar-widget post-category-widget">
			            <h4 class="category-title">Categorias</h4>
			            <categoria @Click="setCategoria" :cate="dataCategoria"></categoria>
			        </div>
				    </div>
			</div>
		</div>
    	<div class="col-8 col-sm-8 col-md-8  p-0">
    		<div class="row">
                <div class="col-lg-6 col-md-6">
    				  <post-component :model="datapost.data"></post-component>
                </div>
            </div>
    	</div>
    </div>
</template>
<script>
import Categoria from '../components/categoria';
import PostComponent from '../components/PostComponent';
// import Pagination from 'laravel-vue-pagination';
export default {
	props:['mycategoria','mypost'],
	components: {
		categoria: Categoria,
		'post-component':PostComponent
    },
    data() {
   		return{
   			dataCategoria: null,
   			datapost:null,
   			teste:null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
   		}
   	},
   	created(){
   		this.dataCategoria= this.mycategoria;
   		this.datapost= this.mypost;
   	},
      mounted() {
        // Fetch initial results
        this.getResults();
      },
   	methods:{
         // Our method to GET results from a Laravel endpoint
         getResults(page = 1) {
            axios.get(window.location.pathname+'?page=' + page)
               .then(response => {
                  this.datapost = response.data;
               });
         },
   		setCategoria(categoria){
   			this.teste=categoria;
   			axios.post('api/getcategoriaPost/', {
   				categoria : categoria
   			}).then(
   				 res => {
   					console.log(this.teste);
   				 	this.datapost = res.data;
   				 },
   				 (error) => {
   				 	console.log(error);
   				 });
   		}
   	}
}
</script>