<template>
    <ul class="nav flex-column cat-list mt-20">
        <li class="nav-item" v-for="item in cate">
            <a  v-on:click="myCick" class="nav-link d-flex justify-content-between" v-bind:id="item.nome" v-bind:data-value="item.idcategoria">
                <p>{{item.nome}}</p>
                <p v-if="post_count">{{item.post_count}}</p>
            </a>
        </li>
    </ul>
</template>
<script>
export default {
	props:['cate','post_count'],
    methods:{
        myCick(event){
            var tag;
            tag =event.target;
            while(tag.tagName != 'A'){
                if (tag.tagName != 'LI') {
                    tag = tag.parentNode;
                }else{
                    tag = tag.children[0];
                }
            }
            console.log(tag);
            this.$emit('click', tag.getAttribute('data-value'));
        }
    }
}
</script>