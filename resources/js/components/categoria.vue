<template>
    <ul class="nav flex-column cat-list mt-20">
        <li class="nav-item" v-for="item in cate">
            <a  v-on:click="myCick" class="nav-link d-flex justify-content-between" v-bind:id="item.nome" v-bind:data-value="item.idcategoria">
                <p v-bind:data-value="item.idcategoria">{{item.nome}}</p>
            </a>
        </li>
    </ul>
</template>
<script>
export default {
	props:['cate'],
    methods:{
        myCick(event){
            console.log(event.target);
            this.$emit('click', event.target.getAttribute('data-value'));
        }
    }
}
</script>