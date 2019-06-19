<template>
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3  p-0 sidebar-widgets">
            <div class="widget-wrap">
                <div class="single-sidebar-widget search-widget">
                        <div class="container single-sidebar-widget post-category-widget">
                        <h4 class="category-title">Categorias</h4>
                        <categoria 
                        v-on:click="setCategoria" :cate="categoria"></categoria>
                    </div>
                    </div>
            </div>
        </div>
        <div class="col-8 col-sm-8 col-md-8  p-0">
            <div class="row">
                <div class="col-lg-6 col-md-6" v-for="p in posts.data">
                    <post-component v-if="p" :model="p"></post-component>
                </div>
            </div>
            <vue-pagination :pagination='posts'
                    :posts="posts"
                    @paginate="getPosts"
                    @mypost="setPosts"
                :offset="1">
        </vue-pagination>
        </div>
    </div>
</template>
<script>

import Categoria from './categoria';
import PostComponent from './PostComponent';
import VuePagination from './Pagination.vue';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
export default {
    props: {
        posts:{
            type: Object
        }
    },
	components: {
        categoria: Categoria,
        VuePagination,
        'post-component':PostComponent
    },
    data: {
        teste:null,
        posts: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
    },
    mounted() {
      // if (!this.mypost) {
      //     this.getPosts();
      // }else{
      //   this.posts=this.mypost;
      // }
      // // this.getPosts();
    },
    methods:{
        setCategoria: function (categoria){
            console.log(categoria);
            this.teste=categoria;
            axios.post('api/getcategoriaPost/', {
                categoria : categoria
            }).then(
                 res => {
                    this.posts = res.data;
                 },
                 (error) => {
                    console.log(error);
                 });
        },
        getPosts(page) {
            console.log(`/api/getcategoriaPost?page=${page}`);
            axios.get(`/api/getcategoriaPost?page=${page}`)
                .then((response) => {
                    console.log(response.data);
                    this.posts = response.data;
                })
                .catch(() => {
                    console.log('handle server error from here');
                });
        },
        setPosts(posts) {
            this.mypost=posts;
        }
    }
}
</script>