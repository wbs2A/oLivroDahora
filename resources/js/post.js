
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

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
import UploadFiles from './components/UploadFiles';
import CreatePost from './components/CreatePost';
import EditPost from './components/EditPost';
import VueResource from "vue-resource";
import Comment from './components/Comments.vue';
Vue.use(VueResource);

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
const post = new Vue({
    el: '#post',
    components:{
        'post-component': PostComponent,
        VuePagination,
        Comment,
        'post': Post,
        'upload-files': UploadFiles,
        'edit-post':EditPost,
        'create-post':CreatePost
    }
});