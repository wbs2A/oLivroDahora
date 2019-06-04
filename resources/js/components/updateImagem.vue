<template>
    <span>
        <div v-for="(file, key) in files" class="file-listing">
            <img class="preview rounded col-2" v-bind:ref="'preview'+parseInt(key)" />
                                                                                       
            <div class="success-container" v-if="file.id > 0">
                Success
                <input type="hidden" :name="input_name" :value="file.id"/>
            </div>
            <div class="remove-container" v-else>
                <a class="remove" v-on:click="removeFile(key)">Remover</a>
            </div>
        </div>
        <label  class="text-center m-0 p-0" >
            <i :class="' icon '+cla" :style="'font-size:'+size+'px;'" aria-hidden="true"></i>
            <input id="imagem" type="file" name="imagem" accept="image/*" @change="setImagem" style="display: none;">
            <br>
            <span>{{legenda}}</span>
        </label>
    </span>
</template>

<script>
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
    export default {
        props: {
            url:{
                type: String,
                required: true
            },
            cla:{
                type: String,
                required: true
            },
            size:{
                type: String,
                required: true
            },
            legenda:{
                type: String,
                required: false  
            },
            src:{
                type:Object,
                required:false
            }
        },
        data() {
            return {
                files: []
            }
        },
        mounted(){
            console.log(this.src);
            if (this.src) {
                this.$refs['preview'+parseInt(i)][0].src=this.src.filename;
            }
        },
        methods:{
            setImagem(event){
                if (event.target.files.length) {
                    console.log(event.target.files.length);
                    for (var i = 0; i <  document.getElementsByClassName('icon').length; i++) {
                        console.log(document.getElementsByClassName('icon')[i].style.display);
                        document.getElementsByClassName('icon')[i].style.display='none';
                    }
                    this.files =event.target.files;
                    this.getImagePreviews();
                }
            },
            removeFile( key ){
                console.log(typeof this.files);
                if (this.files) {
                    for (var i = 0; i <  document.getElementsByClassName('icon').length; i++) {
                        console.log(document.getElementsByClassName('icon')[i].style.display);
                        document.getElementsByClassName('icon')[i].style.display='block';
                    }
                    this.files =[];
                    document.getElementById('imagem').value=''
                }else{
                    console.log(this.url);
                }
                this.getImagePreviews();
            },
            getImagePreviews(){
                for( let i = 0; i < this.files.length; i++ ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['preview'+parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.files[i] );
                    }
                }
            },
            submitFiles() {
                if (this.files.length) {
                    for( let i = 0; i < this.files.length; i++ ){
                        if(this.files[i].id) {
                            continue;
                        }
                        let formData = new FormData();
                        formData.append('imagem', this.files[i]);
                        axios.post(this.url,
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).then(function(res) {
                            this.$emit('submit', res.data);
                            console.log('success');
                        }.bind(this)).catch(function(data) {
                            console.log(data);
                        });
                    }
                }else{
                    this.$emit('submit');
                    console.log('success');
                }
            }
        }
    }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }
    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }
    div.file-listing img{
        max-width: 90%;
    }
    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }
    div.remove-container{
        text-align: center;
    }
    div.remove-container a{
        color: red;
        cursor: pointer;
    }
    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>