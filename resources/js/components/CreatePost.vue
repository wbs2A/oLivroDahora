<template>
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
                        <label for="title">Insira o título do Post</label>
                        <br>
                        <input class="form-control" v-model="titulo" id="title" name="title" max="45">
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
                        <input class="form-control" id="descricao" v-model="descricao" name="descricao" max="40">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="conteudo">Insira o conteúdo</label><br>
                        <textarea class="form-control" id="conteudo" v-model="conteudo" name="conteudo" cols="60" rows="6"></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label for="categoria">Selecione a categoria:</label>
                        <select v-model="selected" class="form-control" id="categoria" name="categoria">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br><br>
                        <input type="submit" class="btn btn-success form-control" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

    import UploadFiles from './UploadFiles'
    export default {
        name: "CreatePost",
        components:{
            'upload-files': UploadFiles
        },
        data: function(){
          return {
              conteudo: '',
              descricao: '',
              titulo: '',
              files: '',
              errors: [],
              selected: '',
              options: [{'text':'Fashion', value:'1'}, {'text':'Viagens', value:'2'},{text:'Estilo de vida', value:'3'},{text:'Finanças', value:'4'},{text:'Comidinhas', value:'5'}],
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        },
        methods:{
            submitForm: function (e) {
                this.files = this.$refs.uploader.files;
                if(this.conteudo && this.descricao && this.titulo){
                    let formData = new FormData();
                    formData.append('file', this.files);
                    formData.append('conteudo', this.conteudo);
                    formData.append('descricao', this.descricao);
                    formData.append('titulo', this.titulo);
                    axios.post('/' + this.post_url,
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });
                    return true;
                }
                this.errors = [];

                if (!this.conteudo) {
                    this.errors.push('O conteúdo é obrigatório.');
                }
                if (!this.titulo) {
                    this.errors.push('O título é obrigatório.');
                }
                if(!this.descricao){
                    this.errors.push('A descrição é obrigatória.');
                }
                e.preventDefault();
            }
        }
    }
</script>

<style scoped>

</style>