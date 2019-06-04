require('./bootstrap');
window.Vue = require('vue');



import Categoria from './components/categoria';
import PostComponent from './components/PostComponent';
import VuePagination from './components/Pagination.vue';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
const app = new Vue({
    el: '#categoria',
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
      if (!this.mypost) {
          this.getPosts();
      }else{
        this.posts=this.mypost;
      }
      // this.getPosts();
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
});