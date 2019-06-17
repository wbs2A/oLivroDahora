<template>
    <span>
        <div v-for="(file, key) in files" class="file-listing">
            <img class="preview rounded col-2" ref="preview" v-if="file.filename" :src="'/storage/'+file.filename"/>
            <img class="preview rounded col-2" ref="preview" v-else />
            <div class="remove-container" v-if="file">
                <a class="remove" v-on:click="removeFile()">Remover</a>
            </div>
        </div>
        <label  class="m-0 p-0" >
            <i :class="cla" :style="'font-size:'+size+'px;'" aria-hidden="true"></i>
            <input id="imagem" type="file" name="imagem" accept="image/*" @change="setImagem" style="display: none;">
            <span :class="clas + ' row'">{{legenda}}</span>
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
                required: false
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
                type: Object,
                required:false
            }
        },
        watch: { 
            src: function() { // watch it
                console.log(this.src);
                if (this.src && this.src.imagem) {
                    this.files.push(this.src.imagem);
                    console.log(this.files);
                    for (var i = 0; i <  document.getElementsByClassName(this.clas).length; i++) {
                        console.log(document.getElementsByClassName(this.clas)[i].style.display);
                        document.getElementsByClassName(this.clas)[i].style.display='none';
                    }
                    console.log(this.$refs);
                    // console.log(this.$refs.preview);
                    // this.$refs.preview.src='storage/'+this.src.imagem.filename;

                }
            },
            url: function(){
                console.log(this.cla);
                if (this.cla) {
                    var s = this.cla.indexOf('icon');
                    var v = this.cla.substring(s);
                    console.log(v);
                    this.clas=v;
                }
            }
        },
        data() {
            return {
                files: [],
                clas:'icon'
            }
        },
        mounted(){

            console.log(this.cla);
            if (this.cla) {
                var s = this.cla.indexOf('icon');
                var v = this.cla.substring(s);
                console.log(v);
                this.clas=v;
            }
        },
        methods:{
            setImagem(event){
                if (event.target.files.length) {
                    console.log(event.target.files);
                    for (var i = 0; i <  document.getElementsByClassName(this.clas).length && i < 2; i++) {
                        console.log(document.getElementsByClassName(this.clas)[i]);
                        document.getElementsByClassName(this.clas)[i].style.display='none';
                    }
                    console.log(document.getElementById('imagem').parentElement);
                    console.log('te');
                    this.files =event.target.files;
                    console.log('te2');
                    this.getImagePreviews();
                }
            },
            removeFile(){

                if (this.files.length) {
                    console.log(this.clas);
                    for (var i = 0; i <  document.getElementsByClassName(this.clas).length; i++) {
                        console.log(document.getElementsByClassName(this.clas)[i].style.display);
                        document.getElementsByClassName(this.clas)[i].style.display='block';
                    }
                    this.files =[];
                    this.$refs.preview[0].src='';
                    document.getElementById('imagem').value=''
                }else{
                    console.log(this.url);
                }
            },
            getImagePreviews(){
                console.log('te');
                for( let i = 0; i < this.files.length; i++ ){
                    if ( /\.(jpe?g|png|gif|jpg|jfif)$/i.test( this.files[i].name ) ) {
                        console.log(this.files.length);
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs.preview[0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.files[i] );
                    }
                }
            },
            submitFiles() {
                if (this.files.length) {
                    for( let i = 0; i < this.files.length; i++ ){
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
    div.file-listing img{
        max-width: 90%;
    }
    div.file-listing{
        margin: auto;
        /*padding: 10px;*/
        border-bottom: 1px solid #ddd;
    }
    div.file-listing img{
        height: 100px;
    }
    div.remove-container{
        text-align: center;
    }
    div.remove-container a{
        color: red;
        cursor: pointer;
    }
</style>