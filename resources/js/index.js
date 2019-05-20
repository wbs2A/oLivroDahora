
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

import {TinkerComponent} from 'botman-tinker';
Vue.component('botman-tinker', TinkerComponent);
import PostComponent from './components/PostComponent'
import Post from './components/Post'
import UploadFiles from './components/UploadFiles'
import CreatePost from './components/CreatePost'
import EditPost from './components/EditPost'


const app = new Vue({
    el: '#app',
    components:{
        'post-component': PostComponent,
        'post': Post,
        'upload-files': UploadFiles,
        'edit-post':EditPost,
        'create-post':CreatePost
    }
});