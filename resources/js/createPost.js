import Vue from 'vue';
import updateImagem from './components/updateImagem.vue';



new Vue({
    el:"#createPost",
    components:{
        updateImagem
    },
    data: {
        titulo:null,
    },
    mounted(){
        document.getElementById('createPost').addEventListener('submit',this.submitFiles,false);
        console.log('success');
    },
    methods:{
        submitFiles(event){
            event.preventDefault();
            this.$refs.modal.submitFiles();
        },
        setImagem(resposta){
            console.log(resposta);
            if (resposta !== undefined && resposta['success']) {
                document.getElementById('imagem').type="text";
                document.getElementById('imagem').value=resposta['id'];
                document.getElementById('createPost').submit();
            }else{
                document.getElementById('createPost').submit();
            }
            console.log(this.commentsData);
        }
    }
});
