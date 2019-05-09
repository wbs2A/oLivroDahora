<template>
<div>
    <div class="single-amenities">
        <div class="amenities-thumb">

            <img
             class="img-fluid w-100"
             :src="model['path']+model['filename']"
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
                ><span class="ti-comment"></span>{{model['comentario']}}</a
                >
            </div>
            <p>
                {{model['descricao']}}
            </p>

            <div class="d-flex justify-content-between mt-20">
                <div>
                    <a :href="'/viewpost/'+model['idpost']" class="blog-post-btn">
                        Leia mais <span class="ti-arrow-right"></span>
                    </a>
                </div>
                <div class="category">
                    <a href="#">
                        <span class="ti-folder mr-1"></span> {{model['categoria']}}
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
        props:['data','idpost','descricao', 'titulo', 'categoria','model'],

    }
</script>

<style scoped>

</style>