<template>
    <div class="panel-block">
        <div class="chat" v-if="chats.length != 0">
            <div v-for="chat in chats"  style="overflow: auto">
                <div class="chat-right" v-if="chat.user_id == userid">
                    {{chat.chat}}
                </div>
                <div class="chat-left" v-else>
                    {{ chat.chat }}
                </div>
            </div>
        </div>
        <div v-else class="no-message">
            Ainda não há mensagens...
        </div>
        <chat-composer
                v-bind:chats="chats"
                v-bind:friendid="friendid"
                v-bind:userid="userid"></chat-composer>
    </div>
</template>

<script>
    import ChatComposer from './ChatComposer'
    export default {
        props:['chats','userid','friendid'],
        components:{
            'chat-composer': ChatComposer
        },
        name: "Chat"
    }
</script>

<style scoped>
    .panel-block {
        flex-direction: column;
        border: none;
    }
    .chat {
        width: 100%;
        padding: 20px;
        box-shadow: inset 0 0 5px 0 grey;
        margin-bottom: 20px;
        border: 1px solid grey;
        max-height: 600px;
        overflow-x: auto;
    }
    .chat .chat-right, .chat .chat-left {
        max-width: 70%;
        box-shadow: 0 0 8px 0px grey;
        padding: 8px;
        margin: 4px;
    }
    .chat-right {
        float: right;
        background-color: #c9f3b6;
        color: black;
    }
    .chat-left {
        float: left;
        background-color: grey;
        color: white;
    }
    .no-message {
        height: 200px;
        display: flex;
        align-items: center;
    }
</style>