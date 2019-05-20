<template>
    <div style="padding-left: 10px;">
        <div class="row">
            <div class="text-right col">
                <a href="/createpost/" class="btn btn-primary"><i class="fas fa-plus"> </i>Inserir Post</a>
                <div class="row">
                    <div  v-for="post,key in posts">
                        <div class="col card">
                            <div class="card-body">
                                <post-component :edit="1" :model="post"></post-component>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-danger text-white " :href="'/deletepost/'+post['idpost']">Excluir Post</a> | <a class="btn btn-secondary text-white" :href="'/editpost/'+post['idpost']">Editar Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PostComponent from "./PostComponent";
    export default {
        name: "PostManager",
        components: {PostComponent},
        data() {
            return {
                posts: []
            }
        },
        mounted(){
            axios.get('/api/getPostUser/').then(res=>{
                this.posts = res.data;
            });
        }

    }
</script>

<style scoped>

</style>