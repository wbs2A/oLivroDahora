require('./bootstrap');
window.Vue = require('vue');
import FilterCategoria from './components/filtercategoria.vue';
const app = new Vue({
    el: '#categoria',
    components:{
        categoria: FilterCategoria
    }
});