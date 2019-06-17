
require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};


const carrinho = new Vue({
    el: '#carrinho',
    methods:{
      deleteCompra: function (id){
        console.log(id);
        // axios.delete('api/carrinho/'+id).then(
        //    res => {
        //     console.log(res.data);
        //    },
        //    (error) => {
        //     console.log(error);
        // });
      }
    }
});