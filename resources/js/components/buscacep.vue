<script>
    export default{
        props: {
          cep: String,
          onde: String
        },
        methods: {
            onBlurCep(){
                var a ='cep'+this.onde;
                console.log(document.getElementById(a).value);
                if(document.getElementById(a).value){
                    var res = document.getElementById(a).value.replace('-', "");
                    console.log(res);
                    var dat;
                    $.ajax({
                        url:    'https://api.postmon.com.br/v1/cep/'+res,
                        type:   "get",
                        dataType:"json",
                        async: false,
                        success: function( data ){
                            dat = data;           
                        }
                    });
                    console.log(dat);
                    if (dat) {
                        var b="#bairro"+this.onde;
                        var c= "#cidade"+this.onde;
                        var e= "#estado"+this.onde;
                        var r= "#rua"+this.onde;
                        console.log(this.onde);
                        $(b).val(dat.bairro);
                        $(c).val(dat.cidade);
                        $(e).val(dat.estado_info.nome);
                        $(r).val(dat.logradouro);
                    
                    }
                }
            }
        }
    }

</script>

<template>
    <div class="col mb-3">
        <label for="cep" class="col-form-label text-md-right">CEP</label>
        <input type="text" class="form-control" data-mask="00000-000" v-bind:value="cep | formatCep" v-bind:id="'cep'+onde" name="cep" @blur="onBlurCep" placeholder="">
    </div>
</template>

<style scoped=""></style>
