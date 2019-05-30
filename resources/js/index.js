
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import PostComponent from './components/PostComponent.vue';
import Post from './components/Post.vue';
import VuePagination from './components/Pagination.vue';
import axios from 'axios';
import UploadFiles from './components/UploadFiles'
import CreatePost from './components/CreatePost'
import EditPost from './components/EditPost'

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};


const index = new Vue({
    el: '#index',
    props:['tes'],
    components:{
        'post-component': PostComponent,
        VuePagination,
        'post': Post,
        'upload-files': UploadFiles,
        'edit-post':EditPost,
        'create-post':CreatePost
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
        mypost:null,
        offset: 4,
    },
    mounted() {
      console.log(this.tes);
      if (!this.mypost) {
          this.getPosts();
      }else{
        this.posts=this.mypost;
      }
    },
    methods:{
      setCategoria: function (categoria){
        console.log(categoria);
        this.teste=categoria;
        axios.post('api/getcategoriaPost/', {
          categoria : categoria
        }).then(
           res => {
            console.log(this.teste);
            this.posts = res.data;
            console.log(res.data);
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


});