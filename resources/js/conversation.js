window.Vue = require('vue');


import Vue from 'vue'
import Chat from './components/Chat'
import ChatComposer from './components/ChatComposer'
import axios from 'axios';
import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '562044e057c612c4eb6d',
    cluster: 'us2'
});


Vue.component('chat-composer', require('./components/ChatComposer.vue'));
const app = new Vue({
    el:'#app',
    data:{
        chats:''
    },
    components:{
        'chat': Chat,
        'chat-composer': ChatComposer
    },
    created(){
        const userId = $('meta[name="userId"]').attr('content');
        const friendId = $('meta[name="friendId"]').attr('content');

        if(friendId != undefined){
            axios.get('/api/chat/getChat/'+friendId).then((response)=>{
                this.chats = response.data;
            })
        }
        window.Echo.private('Chat.'+friendId+'.'+userId)
            .listen('BroadcastChat', (e)=>{
               this.chats.push(e);
            });
    }
});