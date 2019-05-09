<style scoped="">
    .center {
        margin: auto;
        width: 50%;
        padding: 100px;
        padding-left: 20%;
    }

    .edit{
        position: relative;
        float: right;
    }
    .swapping-squares-spinner, .swapping-squares-spinner * {
    box-sizing: border-box;
}

.swapping-squares-spinner {
    height: 65px;
    width: 65px;
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.swapping-squares-spinner .square {
    height: calc(150px * 0.25 / 1.3);
    width:  calc(150px * 0.25 / 1.3);
    animation-duration: 1000ms;
    border: calc(65px * 0.04 / 1.3) solid #000000;
    margin-right: auto;
    margin-left: auto;
    position: absolute;
    animation-iteration-count: infinite;
}

.swapping-squares-spinner .square:nth-child(1) {
    animation-name: swapping-squares-animation-child-1;
    animation-delay: 500ms;
}

.swapping-squares-spinner .square:nth-child(2) {
    animation-name: swapping-squares-animation-child-2;
    animation-delay: 0ms;
}

.swapping-squares-spinner .square:nth-child(3) {
    animation-name: swapping-squares-animation-child-3;
    animation-delay: 500ms;
}

.swapping-squares-spinner .square:nth-child(4) {
    animation-name: swapping-squares-animation-child-4;
    animation-delay: 0ms;
}

@keyframes swapping-squares-animation-child-1 {
    50% {
        transform: translate(150%,150%) scale(2,2);
    }
}

@keyframes swapping-squares-animation-child-2 {
    50% {
        transform: translate(-150%,150%) scale(2,2);
    }
}

@keyframes swapping-squares-animation-child-3 {
    50% {
        transform: translate(-150%,-150%) scale(2,2);
    }
}

@keyframes swapping-squares-animation-child-4 {
    50% {
        transform: translate(150%,-150%) scale(2,2);
    }
}
button{
    color: #eee;
}
    .head{
        font-size: 25px;
    }
    .cardbody{
        font-size: 17px;

    }
    b{
        color: #0b0b0b;
    }
</style>

<template>
    <div  class="">
        <div v-if="error" class="error">
            <h1>{{ error }}</h1>
        </div>
        <div class="">
            <fisica-home></fisica-home>
        </div>
    </div>
</template>

<script>
    import FisicaHome from "./FisicaHome.vue";

    export default {
        components: {FisicaHome},
        data() {
            return {
                error: null
            };
        },
        methods: {
            submitItem(evt, formid){
                evt.preventDefault();
                document.getElementById(formid).submit();
            },
            formatDate(data, formato) {
                if (formato == 'pt-br') {
                    return (data.substr(0, 10).split('-').reverse().join('/'));
                } else {
                    return (data.substr(0, 10).split('/').reverse().join('-'));
                }
            },
        }
    }

</script>