<template>
    <div>

        <div class="container">
            <div class="card">

                <p v-if="errors.length">
                    <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                <ul><li v-for="error in errors">{{ error }}</li></ul>
                </p>


                <form id="createpostForm" action="/api/insertPost/" method="post">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <div class="row">
                        <div class="col">
                            <label for="title">Título do Post</label>
                            <br>
                            <input class="form-control" v-model="model[0]['titulo']" id="title" name="title" max="45">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="img">Insira a imagem do Post</label>
                            <br>
                            <upload-files id="img" name="img" ref="uploader"></upload-files>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="descricao">Insira a descrição</label>
                            <br>
                            <input class="form-control" id="descricao" v-model="model[0]['descricao']" name="descricao" max="40">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="conteudo">Insira o conteúdo</label><br>
                            <textarea class="form-control" id="conteudo" v-model="model[0]['conteudo']" name="conteudo" cols="60" rows="6"></textarea>
                        </div>
                    </div><br>
                    <div class="col">
                        <input type="submit" class="btn btn-success form-control" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "EditPost",
        props:['model']
    }
</script>

<style scoped>

</style>