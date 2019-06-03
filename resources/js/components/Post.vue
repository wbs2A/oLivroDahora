<template>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h1>{{model[0]['titulo']}}</h1>
                    
                </div>
                    <star-rating v-if="user" :inline="true" :star-size="20"   @current-rating="showCurrentRating" @rating-selected="setCurrentSelectedRating" :increment="0.5"></star-rating>
                </div>
            </div>
            <div class="card-body">
                <img v-if="model[0]['imagens']['length']"
                        class="img-fluid w-80"
                        style="display: block;  margin-left: auto;  margin-right: auto;"
                        :src="'/'+model[0]['imagens'][0]['path']+model[0]['imagens'][0]['filename']"
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
    import StarRating from 'vue-star-rating';
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    export default {
       name: "Post",
       props: ['model','user'],
       components: {
          StarRating
        },
        methods: {
            showCurrentRating: function(rating) {
                this.currentRating = (rating === 0) ? this.currentSelectedRating : "Click to select " + rating + " stars"
            },
            setCurrentSelectedRating: function(rating) {
                this.currentSelectedRating = "You have Selected: " + rating + " stars";
                axios.post('/api/avaliacao',{
                    idpost: this.model[0]['idpost'],
                    quantidade: rating,
                    user_iduser: this.user.iduser
                }).then(res=>{
                    console.log(res.data);
                });
            }
        },
        mounted(){
            // console.log(this.model);
            // // if (this.model[0]['avaliacoes']) {
            //     avaliacao = model[0]['avaliacoes']['quantidade'];
            // }
        },
        data() {
            return {
                rating: "No Rating Selected",
                currentRating: "No Rating",
                currentSelectedRating: "No Current Rating",
                avaliacao: 0,
            }
        }
    }
</script>

<style scoped>
body {
  font-family: 'Raleway', sans-serif;
}

.custom-text {
  font-weight: bold;
  font-size: 1.9em;
  border: 1px solid #cfcfcf;
  padding-left: 10px;
  padding-right: 10px;
  border-radius: 5px;
  color: #999;
  background: #fff;
}
</style>