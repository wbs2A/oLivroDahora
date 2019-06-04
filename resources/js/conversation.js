window.Vue = require('vue');


import Vue from 'vue'
import Chat from './components/Chat'
import axios from 'axios';
const app = new Vue({
    el:'#app',
    data:{
        chats:''
    },
    components:{
        'chat': Chat
    },
    created(){
        const userId = $('meta[name="userId"]').attr('content');
        const friendId = $('meta[name="friendId"]').attr('content');

        if(friendId != undefined){
            axios.post('/api/chat/getChat/'+friendId).then((response)=>{
                this.chats = response.data;
            })
        }
    }
});