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
            <div class="col-lg-6 col-md-6" v-for="p in datapost">
                <div class="single-amenities">
                    <div class="amenities-thumb">
                        <img
                            class="img-fluid w-100"
                            src=""
                            alt=""
                        />
                    </div>
                    <div class="amenities-details">
                       <h5>
                            <a href="#">{{ p.titulo }}</a>
                        </h5>
	                    <div class="amenities-meta mb-10">
                           <a href="#" class=""><span class="ti-calendar"></span>{{ p.datapostagem }}</a
                                            >
                            <a href="#" class="ml-20"><span class="ti-comment"></span>{{ p.comentario }}</a
                                            >
                        </div>
                        <p>{{ p.descricao }}</p>

                        <div class="d-flex justify-content-between mt-20">
                            <div>
                                <a href="#" class="blog-post-btn">Leia mais <span class="ti-arrow-right"></span></a>
                            </div>
                            <div class="category">
                                <a href="#"><span class="ti-folder mr-1"></span> {{ p.categoria }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
</template>
<script>
import Categoria from '../components/categoria';
export default {
	props:['mycategoria','mypost'],
	components: {
		categoria: Categoria
   	},
   	data() {
   		return{
   			dataCategoria: null,
   			datapost:null,
   			teste:null
   		}
   	},
   	created(){
   		this.dataCategoria= this.mycategoria;
   		this.datapost= this.mypost;
   	},
   	methods:{
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