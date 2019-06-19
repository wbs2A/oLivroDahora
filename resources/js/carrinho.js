import viewCarrinho from './components/viewCarrinho.vue';
import gerenciaCategoria from './components/gerenciaCategoria.vue';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#app',
    components:{
        viewCarrinho
    }
});