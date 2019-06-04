require('./bootstrap');
window.Vue = require('vue');


import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from './components/home'
import moment from 'moment';
import Vue2Filters from 'vue2-filters'
import VeeValidate from 'vee-validate' 
import PostManager from './components/PostManager'

Vue.use(Vue2Filters);
Vue.use(VeeValidate);

Vue.config.productionTip = false;

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
});

Vue.filter('formatCep', function(value) {
    if (value) {
        value = value.slice(0,5)+'-'+value.slice(5); 
        console.log(value);
        return value;
    }
});
Vue.filter('formatTelefone', function(value) {
    if (value) {
        value = "("+value;
        value =  [value.slice(0,3),")", value.slice(3)].join('');
        return [value.slice(0,9),"-", value.slice(9)].join('');
    }
});

const bus = new Vue({
    data(){
        return {
            info: null,
            name:null
        }
    }
});
export default bus

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path: window.location.pathname+'/',
            name: 'home',
            component: Home
        },
        {
            path: window.location.pathname+'/post',
            name: 'post',
             component: PostManager,
        }
        // {
        //     path: window.location.pathname+'/comments',
        //     name: 'comments',
        //     component: Comments,
        // },
    ],
});

const dashapp = new Vue({
    el:'#dashboard',
    data:{
        info: null
    },
    router,
});