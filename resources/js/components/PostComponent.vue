<template>
<div>
    <div class="single-amenities">
        <div class="amenities-thumb col">
            <img v-if="model.imagens.length"
             class="img-fluid w-50"
            :src="'/storage/'+model.imagens[0]['filename']"
            alt=""
            />
        </div>
        <div class="amenities-details">
            <h5>
                <a :href="'/viewpost/'+model['idpost']"
                >{{model['titulo']}}
                </a>
            </h5>
            <div class="amenities-meta mb-10">
                <a href="#" class=""
                ><span class="ti-calendar"></span>{{model['datapostagem']}}</a
                >
                <a href="#" class="ml-20"
                ><span class="ti-comment"></span>{{model['comentarios_count']}}</a
                >
            </div>
            <p>
                {{model['descricao']}}
            </p>

            <div class="d-flex justify-content-between mt-20">
                <div v-if="!edit">
                    <a :href="'/viewpost/'+model['idpost']" class="blog-post-btn">
                        Leia mais <span class="ti-arrow-right"></span>
                    </a>
                </div>
                <div class="category">
                    <a @click="href(model['categoria']['idcategoria'])">
                        <span class="ti-folder mr-1"></span> {{model['categoria']['nome']}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "PostComponent",
        props:['edit','idpost','descricao', 'titulo', 'categoria','model'],
        methods:{
            href:function (categoria) {
                console.log(categoria);
                this.teste=categoria;
                var form = document.createElement("form");
                // form.method = "post";
                form.action = '/categoria';
                var element2 = document.createElement("input");  
                element2.value=categoria; 
                element2.name="id";
                var element3 = document.createElement("input");  
                element3.value=document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
                element3.name="_token";
                element3.type="hidden";
                form.appendChild(element2);
                form.appendChild(element3);
                document.body.appendChild(form);
                form.submit();
            }
        },
    }
</script>

<style scoped>

</style>