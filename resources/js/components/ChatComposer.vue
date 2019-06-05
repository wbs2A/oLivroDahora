<template>
    <div class="panel-block field">
        <div class="control">
            <div class="row">
                <div class="text-center">
                    <input type="text" class="form-control input" v-on:keyup.enter="sendChat" v-model="chat">
                </div>
                <div class="text-center">
                    <button class="btn btn-success" v-on:click="sendChat"> Enviar <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ChatComposer",
        props: ['chats', 'userid', 'friendid'],
        data() {
            return {
                chat: ''
            }
        },
        methods: {
            sendChat: function(e) {
                if (this.chat != '') {
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        user_id: this.userid
                    }
                    this.chat = '';
                    axios.post('/api/chat/sendChat', data).then((response) => {
                        this.chats.push(data)
                    })
                }
            }
        }
    }
</script>

<style scoped>
    .panel-block {
        flex-direction: row;
        width: 100%;
        border: none;
        padding: 0;
    }
    input {
        border-radius: 0;
    }
    .auto-width {
        width: auto;
    }
</style>