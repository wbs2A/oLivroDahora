<script>
    export default{
        props: {
          cpf: String
        },
        methods: {
            getCpf(){
              var a;
              var res = document.getElementById("cpf").value.replace('.', "");
              res = res.replace('-', ""); 
              res =res.replace('.', "");
              a= document.getElementById('register').action.replace('register','api/userInsertCpf')+'/'+res;
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });
                $.ajax({
                  url: a,
                  method: 'get',
                  success: function(result){
                        if(result['resposta']){
                          var te;
                                te=document.getElementById('fisica-cpf');
                                te.innerText=result['resposta'];
                                te.parentNode.style.display='block';
                                document.getElementsByTagName('button')[0].disabled=true;

                        }else{
                          var te2;
                          te2=document.getElementById('fisica-cpf');
                          te2.parentNode.style.display='none';
                          document.getElementsByTagName('button')[0].disabled=false;                          
                        }             
                  }});
            }
        }
    }

</script>

<template>
    <div  class="col  p-0 mr-1 ml-1 mb-3">
        <label for="cpf" class="col-form-label text-md-right">CPF </label>
        <input type="text" class="form-control" data-mask="000.000.000-00" v-bind:value="cpf" id="cpf" maxlength="11" @blur="getCpf" name="cpf" placeholder="CPF" value="">
        
    </div>
</template>

<style scoped=""></style>