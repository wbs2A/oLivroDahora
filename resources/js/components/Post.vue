<template>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h1>{{model[0]['titulo']}}</h1>
            </div>
            <div class="card-body">
                <img
                        class="img-fluid w-80"
                        style="display: block;  margin-left: auto;  margin-right: auto;"
                        :src="'/'+model[0]['path']+model[0]['filename']"
                        alt=""
                />
                <h3>{{model[0]['descricao']}}</h3>
                <p>{{model[0]['conteudo']}}</p>
            </div>
            <div class="card-footer">
                <em class="text-right">{{model[0]['datapostagem']}}</em>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       name: "Post",
       props: ['model']
    }
</script>

<style scoped>

</style>