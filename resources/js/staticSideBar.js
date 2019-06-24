require('./bootstrap');
window.Vue = require('vue');



import Categoria from './components/categoria';
import axios from 'axios';
import Livro from './components/livro';
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

const app = new Vue({
    el: '#sideBar',
	  components: {
		  categoria: Categoria,
      livro: Livro,
    },
    data: {
   		teste:null,
   	},
   	methods:{
   		setCategoria: function (categoria){
   			console.log(categoria);
   			this.teste=categoria;
        var form = document.createElement("form");
        // form.method = "post";
        form.action = '/categoria';
        var element2 = document.createElement("input");  
        element2.value=categoria; 
        element2.name="id";
        var element3 = document.createElement("input");  
        element3.value=document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
        element3.name="_token";
        element3.type="hidden";
        form.appendChild(element2);
        form.appendChild(element3);
        document.body.appendChild(form);
        form.submit();
      }
    }
});