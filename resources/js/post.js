require('./bootstrap');
import Vue from 'vue';
import PostComponent from './components/PostComponent.vue';
import Post from './components/Post.vue';
import axios from 'axios';
import Comment from './components/Comments.vue';
import VueResource from "vue-resource";
Vue.use(VueResource);

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#post',
    components:{
        'post-component': PostComponent,
        Comment,
        'post': Post,
    }
});