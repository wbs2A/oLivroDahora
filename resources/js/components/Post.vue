<template>
    <div class="col">
        <div class="card">
            <div class="card-header row-10 m-0 p-0">

                <div class="col-10">
                    <h1>{{model[0]['titulo']}}</h1>
                </div>
                <div class="col-2">
                        
                        <span v-if="model[0]['avaliacoes']['length'] > 0">
                            <star-rating v-if="user" :inline="true" :show-rating="false" :star-size="20" :rating="model[0]['avaliacoes'][0]['quantidade']"  @current-rating="showCurrentRating" @rating-selected="setCurrentSelectedRating" :increment="0.5"></star-rating>
                        </span>
                        <span v-else>
                            <star-rating v-if="user" :show-rating="false" :inline="true" :star-size="20"  @current-rating="showCurrentRating" @rating-selected="setCurrentSelectedRating" :increment="0.5"></star-rating>

                        </span>
                    </div>

            </div>
            <div class="card-body">
                <img v-if="model[0]['imagens']['length'] > 0"
                        class="img-fluid w-80"
                        style="display: block;  margin-left: auto;  margin-right: auto;"
                        :src="'/storage/'+model[0]['imagens'][0]['filename']"

                />
                <h3 class="text-center">{{model[0]['descricao']}}</h3>
                <div style="padding-top: 5px;" v-html="model[0]['conteudo']">
                </div>
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
                if (this.model[0]['avaliacoes']['length'] > 0) {
                    console.log(this.model[0]);
                    axios.post('/api/avaliacao/'+this.model[0]['avaliacoes'][0]['idavaliacao'],{
                        quantidade: rating
                    }).then(res=>{
                        console.log(res.data);
                    });
                }else{
                    axios.post('/api/avaliacao',{
                        idpost: this.model[0]['idpost'],
                        quantidade: rating,
                        user_iduser: this.user.iduser
                    }).then(res=>{
                        console.log(res.data);
                    });
                }
            }
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