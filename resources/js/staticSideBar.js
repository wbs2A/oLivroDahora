require('./bootstrap');
window.Vue = require('vue');



import Categoria from './components/categoria';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
const app = new Vue({
    el: '#sideBar',
	  components: {
		  categoria: Categoria,
    },
    data: {
   		teste:null,
   	},
   	methods:{
   		setCategoria: function (categoria){
   			console.log(categoria);
   			this.teste=categoria;
        var form = document.createElement("form");
        form.method = "get";
        form.action = '/categoria';
        var element2 = document.createElement("input");  
        element2.value=categoria; 
        element2.name="id";
        form.appendChild(element2);
        document.body.appendChild(form);
        form.submit();
      }
    }
});