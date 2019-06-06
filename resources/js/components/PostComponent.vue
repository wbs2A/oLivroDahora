<template>
<div>
    <div class="single-amenities">
        <div class="amenities-thumb">
            <img v-if="model.imagens.length"
             class="img-fluid w-100"
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
                    <a href="#">
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
    }
</script>

<style scoped>

</style>